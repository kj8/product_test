<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller_Frontend {

	public function action_index() {
		$values = $this->request->param('values');
		if ($values == 'index') {
			$this->request->redirect('search');
		}

		$values = explode(',', $values);
		$values = array_map('intval', $values);
		$values = array_filter($values);

		if ($_POST) {
			if (!empty($_POST['value']) && is_array($_POST['value'])) {
				$_POST['value'] = array_map('intval', $_POST['value']);
				$values = array_unique(array_merge($values, $_POST['value']));
				$this->request->redirect('search/' . implode(',', $values));
			}
		}

		$this->template->set('pageName', __('Products list'));

		$products = $this->getProducts($values);
		$attributes = $this->getAtributes();

		$this->template
				->set('content', View::factory('search/index')
						->set('products', $products)
						->set('values', $values)
						->set('attributes', $attributes)
				)
				->set('pageName', __('Search products'))
		;
	}

	private function getAtributes() {
		$_attributes = DB::select('a.id, a.name, v.id as vid, v.value')
				->from(array('product_attribute', 'a'))
				->join(array('product_attribute_value', 'v'))
				->on('v.id_attribute', '=', 'a.id')
				->execute()
				->as_array();

		$attributes = array();
		foreach ($_attributes as $a) {
			$id = (string) $a['id'];

			if (!isset($attributes[$id])) {
				$a['values'] = array();
				$attributes[$id] = $a;
				unset($attributes[$id]['vid'], $attributes[$id]['value']);
			}

			if ($a['vid']) {
				$attributes[$id]['values'][] = array(
					'id' => $a['vid'],
					'value' => $a['value'],
				);
			}
		}

		return $attributes;
	}

	private function getGroupedValues() {
		$_attributes = DB::select('a.id, v.id as vid')
				->from(array('product_attribute', 'a'))
				->join(array('product_attribute_value', 'v'), 'LEFT')
				->on('v.id_attribute', '=', 'a.id')
				->execute()
				->as_array()
		;

		$attributes = array();
		foreach ($_attributes as $k => $v) {
			if (!isset($attributes[$v['id']])) {
				$attributes[$v['id']] = array();
			}
			if ($v['vid']) {
				$attributes[$v['id']][] = $v['vid'];
			}
		}

		return $attributes;
	}

	private function getProducts(array $values) {
		$products = DB::select('p.*')
				->from(array('product', 'p'));

		if ($values) {
			$groupedValues = $this->getGroupedValues();
			if ($groupedValues) {
				$attributesNotIncluded = array();

				foreach ($groupedValues as $k => $v) {
					$v = array_intersect($v, $values);

					if ($v) {
						$subQuery = DB::select('p2v.id_product')->from(array('product_product2attribute_value', 'p2v'))
								->join(array('product_attribute_value', 'v'))->on('v.id', '=', 'p2v.id_value')
								->join(array('product_attribute', 'a'))->on('a.id', '=', 'v.id_attribute')->on('a.id', '=', DB::expr($k))
								->where('v.id', 'IN', $v)
						;
						$products = $products->join(array($subQuery, 'j' . $k), 'INNER')->on('j' . $k . '.id_product', '=', 'p.id');
					} else {
						$attributesNotIncluded[] = $k;
					}
				}

			}
		}

		$products = $products->group_by('p.id')->execute()->as_array();

		foreach ($products as $k => $v) {
			$products[$k]['attributes'] = DB::select()
					->from(array('product_attribute', 'a'))
					->join(array('product_attribute_value', 'v'))
					->on('v.id_attribute', '=', 'a.id')
					->join(array('product_product2attribute_value', 'p2v'))
					->on('p2v.id_value', '=', 'v.id')
					->where('p2v.id_product', '=', $v['id'])
					->execute()
					->as_array();
		}

		return $products;
	}

}

<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Product extends Controller_Frontend {

	public function action_index() {
		$products = DB::select()->from('product')->execute()->as_array();

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

		$this->template
				->set('content', View::factory('product/index')->set('products', $products))
				->set('pageName', __('Products list'))
				
		;
	}

	public function action_add() {

		$values = $this->getAtributes();

		if ($_POST && !empty($_POST['id_value'])) {
			$_POST['id_value'] = array_filter($_POST['id_value']);
			$_POST['id_value'] = array_unique($_POST['id_value']);
			$_POST['id_value'] = array_values($_POST['id_value']);
		}

		if ($_POST && !empty($_POST['name'])) {
			list($id_product) = DB::insert('product', array('name'))->values(array($_POST['name']))->execute();

			if (!empty($_POST['id_value'])) {
				foreach ($_POST['id_value'] as $k => $v) {
					DB::insert('product_product2attribute_value', array('id_product', 'id_value'))
							->values(array($id_product, $v))->execute();
				}
			}

			$this->addMessage(__('Product added'), Message::TYPE_SUCCESS);
			$this->request->redirect('product');
		}

		if ($_POST) {
			$data = $_POST;
		} else {
			$data = array(
				'name' => '',
			);
		}

		$this->template
				->set('content', View::factory('product/edit')
						->set('data', $data)
//						->set('attributes', $attributes)
						->set('values', $values)
				)
				->set('pageName', __('Add product'))
		;
	}

	public function action_edit() {
		$id_product = (int) $this->request->param('id');

		$product = DB::select()->from('product')->where('id', '=', $id_product)->execute()->current();
		if (!$product) {
			$this->request->redirect('product');
		}

		$values = $this->getAtributes();

		if ($_POST && !empty($_POST['id_value'])) {
			$_POST['id_value'] = array_filter($_POST['id_value']);
			$_POST['id_value'] = array_unique($_POST['id_value']);
			$_POST['id_value'] = array_values($_POST['id_value']);
		}

		if ($_POST && !empty($_POST['name'])) {
			DB::update('product')->set(array('name' => $_POST['name']))->where('id', '=', $id_product)->execute();

			DB::delete('product_product2attribute_value')->where('id_product', '=', $id_product)->execute();

			if (!empty($_POST['id_value'])) {
				foreach ($_POST['id_value'] as $k => $v) {
					DB::insert('product_product2attribute_value', array('id_product', 'id_value'))
							->values(array($id_product, $v))->execute();
				}
			}

			$this->addMessage(__('Product changed'), Message::TYPE_SUCCESS);
			$this->request->redirect('product');
		}

		if ($_POST) {
			$data = $_POST;
		} else {
			$data = $product;

			$id_value = DB::select('id_value')->from('product_product2attribute_value')->where('id_product', '=', $id_product)->execute()->as_array();
			$data['id_value'] = array();
			foreach ($id_value as $k => $v) {
				$data['id_value'][] = $v['id_value'];
			}
		}

		$this->template
				->set('content', View::factory('product/edit')
						->set('data', $data)
//						->set('attributes', $attributes)
						->set('values', $values)
				)
				->set('pageName', __('Edit product'))
		;
	}
	
	public function action_delete() {
		$id_product = (int) $this->request->param('id');
		
		$product = DB::select()->from('product')->where('id', '=', $id_product)->execute()->current();
		if ($product) {
			DB::delete('product')->where('id', '=', $id_product)->execute();
			
			$this->addMessage(__('Product deleted'), Message::TYPE_SUCCESS);
		} else {
			$this->addMessage(__('Product does not exists'), Message::TYPE_WARNING);
		}
		
		$this->request->redirect('product');
	}

	private function getAtributes() {
		$_attributes = DB::select('a.id, a.name, v.id as vid, v.value')
				->from(array('product_attribute', 'a'))
				->join(array('product_attribute_value', 'v'))
				->on('v.id_attribute', '=', 'a.id')
				->execute()
				->as_array();

		$attributes = array();
		$values = array('' => '');
		foreach ($_attributes as $a) {
			$id = (string) $a['id'];

			if (!isset($attributes[$id])) {
				$attributes[$id] = array('name' => $a['name'], 'values' => array());
			}

			if (!isset($values[$a['name']])) {
				$values[$a['name']] = array();
			}

			$vid = (string) $a['vid'];
			$values[$a['name']][$vid] = HTML::chars($a['name'] . ': ' . $a['value']);
		}

		return $values;
	}

}

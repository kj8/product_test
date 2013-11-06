<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller_Frontend {

	public function action_index() {
		$this->template->set('pageName', __('Products list'));

		$attributes = $this->getAtributes();

		$this->template
				->set('content', View::factory('search/index')->set('attributes', $attributes))
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

}

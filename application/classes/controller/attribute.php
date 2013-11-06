<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Attribute extends Controller_Frontend {

	public function action_index() {
		$this->template->set('pageName', __('Products list'));

		$attributes = $this->getAtributes();

		$this->template
				->set('content', View::factory('attribute/index')->set('attributes', $attributes))
				->set('pageName', __('Attributes list'))
		;
	}

	public function action_add() {

		if ($_POST && !empty($_POST['name'])) {
			DB::insert('product_attribute', array('name'))->values(array($_POST['name']))->execute();

			$this->addMessage(__('Attribute added'), Message::TYPE_SUCCESS);
			$this->request->redirect('attribute/add');
		}

		if ($_POST) {
			$data = $_POST;
		} else {
			$data = array(
				'name' => '',
			);
		}

		$this->template
				->set('content', View::factory('attribute/edit')
						->set('data', $data)
				)
				->set('pageName', __('Add attribute'))
		;
	}

	public function action_edit() {

		$id_attribute = (int) $this->request->param('id');

		$attribute = DB::select()->from('product_attribute')->where('id', '=', $id_attribute)->execute()->current();
		if (!$attribute) {
			$this->request->redirect('attribute');
		}

		if ($_POST && !empty($_POST['name'])) {
			DB::update('product_attribute')->set(array('name' => $_POST['name']))->where('id', '=', $id_attribute)->execute();

			$this->addMessage(__('Attribute changed'), Message::TYPE_SUCCESS);
			$this->request->redirect('attribute/edit');
		}

		if ($_POST) {
			$data = $_POST;
		} else {
			$data = $attribute;
		}

		$this->template
				->set('content', View::factory('attribute/edit')
						->set('data', $data)
				)
				->set('pageName', __('Edit attribute'))
		;
	}

	private function getAtributes() {
		$_attributes = DB::select('a.id, a.name, v.id as vid, v.value')
				->from(array('product_attribute', 'a'))
				->join(array('product_attribute_value', 'v'), 'LEFT')
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

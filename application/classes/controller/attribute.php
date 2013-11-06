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

		if ($_POST && !empty($_POST['value'])) {
			$_POST['value'] = array_filter($_POST['value']);
			$_POST['value'] = array_unique($_POST['value']);
		}

		if ($_POST && !empty($_POST['name'])) {
			list($id_attribute) = DB::insert('product_attribute', array('name'))->values(array($_POST['name']))->execute();

			if (!empty($_POST['value'])) {
				foreach ($_POST['value'] as $k => $v) {
					DB::insert('product_attribute_value', array('id_attribute', 'value'))
							->values(array($id_attribute, $v))->execute();
				}
			}

			$this->addMessage(__('Attribute added'), Message::TYPE_SUCCESS);
			$this->request->redirect('attribute');
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

		if ($_POST && !empty($_POST['value'])) {
			$_POST['value'] = array_filter($_POST['value']);
			$_POST['value'] = array_unique($_POST['value']);
		}

		if ($_POST && !empty($_POST['name'])) {
			DB::update('product_attribute')->set(array('name' => $_POST['name']))->where('id', '=', $id_attribute)->execute();

			if (!empty($_POST['value'])) {

				DB::delete('product_attribute_value')
						->where('id_attribute', '=', $id_attribute)
						->where('id', 'NOT IN', array_keys($_POST['value']))
						->execute();

				$_valuesIDs = DB::select('id')->from('product_attribute_value')->where('id_attribute', '=', $id_attribute)->execute();
				$valuesIDs = array();
				foreach ($_valuesIDs as $k => $v) {
					$valuesIDs[] = $v['id'];
				}

				foreach ($_POST['value'] as $k => $v) {
					if (in_array($k, $valuesIDs)) {
						DB::update('product_attribute_value')
								->set(array('value' => $v))
								->where('id', '=', $k)
								->where('id_attribute', '=', $id_attribute)
								->execute();
					} else {
						DB::insert('product_attribute_value', array('id_attribute', 'value'))
								->values(array($id_attribute, $v))->execute();
					}
				}
			} else {
				DB::delete('product_attribute_value')
						->where('id_attribute', '=', $id_attribute)
						->execute();
			}

			$this->addMessage(__('Attribute changed'), Message::TYPE_SUCCESS);
			$this->request->redirect('attribute');
		}

		if ($_POST) {
			$data = $_POST;
		} else {
			$data = $attribute;

			$value = DB::select()->from('product_attribute_value')->where('id_attribute', '=', $id_attribute)->execute()->as_array();
			$data['value'] = array();
			foreach ($value as $k => $v) {
				$data['value'][$v['id']] = $v['value'];
			}
		}

		$this->template
				->set('content', View::factory('attribute/edit')
						->set('data', $data)
				)
				->set('pageName', __('Edit attribute'))
		;
	}

	public function action_delete() {
		$id_attribute = (int) $this->request->param('id');

		$attribute = DB::select()->from('product_attribute')->where('id', '=', $id_attribute)->execute()->current();
		if ($attribute) {
			DB::delete('product_attribute')->where('id', '=', $id_attribute)->execute();

			$this->addMessage(__('Attribute deleted'), Message::TYPE_SUCCESS);
		} else {
			$this->addMessage(__('Attribute does not exists'), Message::TYPE_WARNING);
		}

		$this->request->redirect('attribute');
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

<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Value extends Controller_Frontend {

	public function action_add() {

		if ($_POST && !empty($_POST['value']) && !empty($_POST['id_attribute'])) {
			DB::insert('product_attribute_value', array('value', 'id_attribute'))->values(array($_POST['value'], $_POST['id_attribute']))->execute();

			$this->addMessage(__('Value added'), Message::TYPE_SUCCESS);
			$this->request->redirect('value');
		}

		$_attributes = DB::select()->from('product_attribute')->execute()->as_array();
		$attributes = array('' => '');
		foreach ($_attributes as $a) {
			$attributes[$a['id']] = $a['name'];
		}
		
		$this->template
				->set('content', View::factory('value/add')->set('attributes', $attributes))
				->set('pageName', __('Add value'))
		;
	}

}

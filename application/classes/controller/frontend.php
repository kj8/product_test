<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend extends Controller_Template {

	public $template = 'base';
	public $auto_render = TRUE;
	
	protected $message;

	public function __construct(Request $request) {
		parent::__construct($request);

		$this->setUp();
	}

	private function setUp() {
		$this->message = Message::instance();
		i18n::lang('pl');
	}

	protected function addMessage($message, $type) {
		$this->message->add($message, $type);
	}

	protected function getMessages() {
		return $this->message->get();
	}

	public function before() {
		parent::before();

		$this->template
				->set('pageName', '')
				->set('activeMenu', $this->request->controller . '/' . $this->request->action)
			;
	}

	public function after() {
		$this->template->set('messages', View::factory('_element/messages')->set('messages', $this->getMessages()));

		parent::after();
	}

}

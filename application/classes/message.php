<?php

defined('SYSPATH') or die('No direct script access.');

class Message {

	const SESSION_KEY = 'MessageX';
	const TYPE_INFO = 1;
	const TYPE_SUCCESS = 2;
	const TYPE_WARNING = 3;
	const TYPE_ERROR = 4;

	private static $instance;
	private $session;
	private $types;

	private function __construct() {
		$this->session = Session::instance();
	}

	private function __clone() {
		
	}

	public static function instance() {
		if (!self::$instance) {
			self::$instance = new Message();
		}

		return self::$instance;
	}

	public function add($message, $type = null) {
		if (!in_array($type, array(self::TYPE_INFO, self::TYPE_SUCCESS, self::TYPE_WARNING, self::TYPE_ERROR))) {
			$type = self::TYPE_INFO;
		}

		$messages = $this->session->get(self::SESSION_KEY, array());
		$messages[] = array('message' => $message, 'type' => $type);
		$this->session->set(self::SESSION_KEY, $messages);
	}

	public function get() {
		return $this->session->get_once(self::SESSION_KEY, array());
	}

}

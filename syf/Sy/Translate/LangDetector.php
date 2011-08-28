<?php
namespace Sy\Translate;

class LangDetector {

	private static $instance;

	private $lang;

	private function __construct() {
		$this->lang = $this->detect();
	}

	private function detect() {
		$lang = 'default';
		$session = session_id();
		if (empty($session)) session_start ();
		if (isset($_SESSION['sy_language'])) {
			$lang = $_SESSION['sy_language'];
		} elseif (isset($_COOKIE['sy_language'])) {
			$lang = $_COOKIE['sy_language'];
		} elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			$lang = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
			$lang = explode('-', $lang[0]);
			$lang = $lang[0];
		}
		return $lang;
	}

	public function getLang() {
		return $this->lang;
	}

	/**
	 * Singleton method
	 *
	 * @return LangDetector
	 */
	public static function getInstance() {
		if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}

	public function __clone() {
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}

}
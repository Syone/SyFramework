<?php
namespace Sy\Translate;

class LangDetector {

	private static $instances;

	private $lang;

	private $defaultLang;

	private function __construct($defaultLang) {
		$this->defaultLang = $defaultLang;
	}

	private function detect() {
		$lang = $this->defaultLang;
		$session = session_id();
		if (empty($session)) session_start();
		if (!empty($_SESSION['sy_language'])) {
			$lang = $_SESSION['sy_language'];
		} elseif (!empty($_COOKIE['sy_language'])) {
			$lang = $_COOKIE['sy_language'];
		}
		return $lang;
	}

	public function getLang() {
		if (!isset($this->lang)) {
			$this->lang = $this->detect();
		}
		return $this->lang;
	}

	/**
	 * Singleton method
	 *
	 * @return LangDetector
	 */
	public static function getInstance($lang = 'default') {
		if (!isset(self::$instances[$lang])) {
			$c = __CLASS__;
			self::$instances[$lang] = new $c($lang);
		}
		return self::$instances[$lang];
	}

	public function __clone() {
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}

}
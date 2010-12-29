<?php
namespace Sy;

class DebugBar extends WebComponent {

	public function  __construct() {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/DebugBar.tpl', 'php');
		$this->init();
	}

	private function init() {
		$constants = get_defined_constants(true);
		$vars_array['User Constants'] = $constants['user'];
		$vars_array['_REQUEST'] = $_REQUEST;
		$vars_array['_GET'] = $_GET;
		$vars_array['_POST'] = $_POST;
		$vars_array['_COOKIE'] = $_COOKIE;
		$vars_array['_FILES'] = $_FILES;
		$vars_array['_SERVER'] = $_SERVER;
		$vars_array['_ENV'] = $_ENV;
		$this->setVar('VARS_ARRAY', $vars_array);
	}

}
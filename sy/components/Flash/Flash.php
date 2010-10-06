<?php
namespace Sy;

class Flash extends WebComponent {

	private $params;

	public function  __construct($swf, $w = '100%', $h = '100%') {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/Flash.tpl', 'php');
		$this->params = array();
		$this->setSwf($swf);
		$this->setWidth($w);
		$this->setHeight($h);
	}

	public function setSwf($swf) {
		$this->setVar('SWF', $swf);
	}

	public function setWidth($w) {
		$this->setVar('WIDTH', $w);
	}

	public function setHeight($h) {
		$this->setVar('HEIGHT', $h);
	}

	public function setName($name) {
		$this->setVar('NAME', $name);
	}

	public function setId($id) {
		$this->setVar('ID', $id);
	}

	public function setParam($name, $value) {
		$this->params[$name] = $value;
	}

	public function setParams($params) {
		foreach ($params as $name => $value) {
			$this->setParam($name, $value);
		}
	}

	public function __toString() {
		$this->setVar('PARAMS', $this->params);
		return parent::__toString();
	}

}
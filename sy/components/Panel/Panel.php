<?php
namespace Sy;

class Panel extends WebComponent {

	public function __construct() {
		parent::__construct();
		$this->setTemplateFile(dirname(__FILE__) . '/Panel.tpl', 'php');
		$this->setWidth('100%');
	}

	public function setWidth($width) {
		$this->setVar('WIDTH', $width);
	}

}
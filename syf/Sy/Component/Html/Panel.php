<?php
namespace Sy\Component\Html;

use Sy\Component\WebComponent;

class Panel extends WebComponent {

	public function __construct() {
		parent::__construct();
		$this->setTemplateFile(dirname(__FILE__) . '/templates/Panel.tpl', 'php');
		$this->setWidth('100%');
	}

	public function setWidth($width) {
		$this->setVar('WIDTH', $width);
	}

}
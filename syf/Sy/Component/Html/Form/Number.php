<?php
namespace Sy\Component\Html\Form;

class Number extends Text {

	public function __construct() {
		parent::__construct();
		$this->addValidator('Sy\\Component\\Html\\Form\\int');
	}

}
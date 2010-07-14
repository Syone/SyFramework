<?php
namespace Sy\Form;

class Password extends TextElement {

	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'password');
	}
	
}
?>

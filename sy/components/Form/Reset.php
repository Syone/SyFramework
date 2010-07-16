<?php
namespace Sy\Form;

class Reset extends Element {
	
	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'reset');
	}

}
?>

<?php
namespace Sy\Form;

class Hidden extends Element {

	public function __construct() {
		parent::__construct('input');
		$this->setAttribute('type', 'hidden');
	}

}
?>

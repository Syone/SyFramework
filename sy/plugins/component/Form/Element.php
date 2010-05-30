<?php
namespace Sy\Form;

use Sy\WebComponent;

class Element extends WebComponent {

	protected $attributes;

	public function __construct() {
		parent::__construct();
		$this->attributes = array();
	}

	public function setAttributes($attributes) {
		$this->attributes = $attributes;
	}

	public function __toString() {
		$this->setVar('ATTRIBUTES', $this->attributes);
		return parent::__toString();
	}
}
?>

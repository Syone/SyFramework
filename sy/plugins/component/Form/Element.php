<?php
namespace Sy\Form;
use Sy\WebComponent;

class Element extends WebComponent {

	protected $attributes;

	protected $elements;

	public function __construct() {
		parent::__construct();
		$this->attributes = array();
		$this->elements = array();
	}

	public function setAttributes($attributes) {
		$this->attributes = $attributes;
	}

	public function addElement($element) {
		$this->elements[] = $element;
	}

	public function getElements() {
		return $this->elements;
	}

	public function __toString() {
		$this->setVar('ATTRIBUTES', $this->attributes);
		$this->setVar('ELEMENTS', $this->elements);
		return parent::__toString();
	}
}
?>

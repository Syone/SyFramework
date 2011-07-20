<?php
namespace Sy\Component\Html;

class Container extends Element {

	private $elements;

	public function __construct($tagName) {
		parent::__construct($tagName);
		$this->setTemplateFile(__DIR__ . '/templates/Container.tpl', 'php');
		$this->elements = array();
	}

	/**
	 * Add an element
	 *
	 * @param Element $element
	 * @return Element
	 */
	public function addElement(Element $element) {
		$this->elements[] = $element;
		return $element;
	}

	/**
	 * Get contained elements
	 *
	 * @return array Element array
	 */
	public function getElements() {
		return $this->elements;
	}

	/**
	 * Set contained elements
	 *
	 * @param array $elements An array of Element
	 */
	public function setElements(array $elements) {
		$this->elements = $elements;
	}

	/**
	 * Return if the container is empty
	 *
	 * @return bool
	 */
	public function isEmpty() {
		return empty($this->elements);
	}

	public function __toString() {
		if ($this->getTemplateType() == 'php')
			$this->setVar('ELEMENTS', $this->elements);
		return parent::__toString();
	}

}
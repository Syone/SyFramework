<?php
namespace Sy\Component\Html;

use Sy\Component\WebComponent;

class Element extends WebComponent {

	private $tagName;
	private $attributes;
	private $content;

	/**
	 * Element constructor
	 *
	 * @param string $tagName Element tag name
	 */
	public function __construct($tagName) {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Element.tpl', 'php');
		$this->tagName = $tagName;
		$this->attributes = array();
		$this->content = array();
	}

	/**
	 * Get the element attribute
	 *
	 * @param string $name Attribute name
	 * @return string
	 */
	public function getAttribute($name) {
		$name = strtolower($name);
		return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
	}

	/**
	 * Get the element attributes
	 *
	 * @return array
	 */
	public function getAttributes() {
		return $this->attributes;
	}

	/**
	 * Set the element attribute
	 *
	 * @param string $name  Attribute name
	 * @param string $value Attribute value
	 * @param bool Append the value
	 */
	public function setAttribute($name, $value, $append = false) {
		$name = strtolower($name);
		if ($append) {
			$actual = $this->getAttribute($name);
			$value = is_null($actual) ? $value : $actual . $value;
		}
		$this->attributes[$name] = $value;
	}

	/**
	 * Set the element attributes
	 *
	 * @param array $attributes Array of element attributes
	 */
	public function setAttributes(array $attributes) {
		foreach ($attributes as $name => $value) {
			$this->setAttribute($name, $value);
		}
	}

	/**
	 * Set the element content
	 *
	 * @param string $content Element content
	 */
	public function setContent($content) {
		$this->content[0] = trim($content);
	}

	/**
	 * Get the element content
	 *
	 * @return string
	 */
	public function getContent() {
		return $this->content[0];
	}

	/**
	 * Add an element
	 *
	 * @param Element $element
	 * @return Element
	 */
	public function addElement(Element $element) {
		$this->content[] = $element;
		return $element;
	}

	/**
	 * Get contained elements
	 *
	 * @return array Element array
	 */
	public function getElements() {
		return $this->content;
	}

	/**
	 * Set contained elements
	 *
	 * @param array $elements An array of Element
	 */
	public function setElements(array $elements) {
		$this->content = $elements;
	}

	/**
	 * Return if the element has a content or not
	 *
	 * @return bool
	 */
	public function isEmpty() {
		$content = array_filter($this->content);
		return empty($content);
	}

	public function __toString() {
		$this->setVar('TAG_NAME', $this->tagName);
		foreach ($this->attributes as $name => $value) {
			$this->setVar('NAME', $name);
			$this->setVar('VALUE', $value);
			$this->setBlock('BLOCK_ATTRIBUTES');
		}
		$elements = array_filter($this->content);
		if ((count($elements) > 1) or (!empty($elements) and $elements[0] instanceof Element))
			array_unshift($elements, "\n");
		foreach ($elements as $element) {
			if ($element instanceof Element)
				$this->setComponent('ELEMENT', $element);
			else
				$this->setVar('ELEMENT', $element);
			$this->setBlock('BLOCK_CONTENT');
		}
		return parent::__toString();
	}

}
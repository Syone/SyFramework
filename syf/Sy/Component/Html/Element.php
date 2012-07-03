<?php
namespace Sy\Component\Html;

use Sy\Component\WebComponent;

class Element extends WebComponent {

	/**
	 * @var string
	 */
	private $tagName;

	/**
	 * @var array
	 */
	private $attributes;

	/**
	 * @var array
	 */
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
	 */
	public function setAttribute($name, $value) {
		$name = strtolower($name);
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
	 * Get the element content
	 *
	 * @return array
	 */
	public function getContent() {
		return array_filter($this->content);
	}

	/**
	 * Set the element content
	 *
	 * @param array $content Element content
	 */
	public function setContent(array $content) {
		$this->content = $content;
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
	 * Add text in content
	 *
	 * @param string $text
	 */
	public function addText($text) {
		$this->content[] = trim($text);
	}

	/**
	 * Return if the element has a content or not
	 *
	 * @return bool
	 */
	public function isEmpty() {
		$content = $this->getContent();
		return empty($content);
	}

	public function __toString() {
		$this->setVar('TAG_NAME', $this->tagName);
		foreach ($this->attributes as $name => $value) {
			$this->setVar('NAME', $name);
			$this->setVar('VALUE', $value);
			$this->setBlock('BLOCK_ATTRIBUTES');
		}
		foreach ($this->getFormattedContent() as $element) {
			if ($element instanceof Element)
				$this->setComponent('ELEMENT', $element);
			else
				$this->setVar('ELEMENT', $element);
			$this->setBlock('BLOCK_CONTENT');
		}
		return parent::__toString();
	}

	private function getFormattedContent() {
		$content = $this->getContent();
		if (empty($content)) return $content;
		if (count($content) > 1) {
			$content = array_map(function($value) {
				return is_string($value) ? $value . "\n" : $value;
			}, $content);
			array_unshift($content, "\n");
		}
		if (count($content) == 1 and current($content) instanceof Element)
			array_unshift($content, "\n");
		return $content;
	}

}
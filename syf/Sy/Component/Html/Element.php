<?php
namespace Sy\Component\Html;
use Sy\Component\WebComponent;

class Element extends WebComponent {

	private $tagName;
	private $content;
	private $attributes;

	public function __construct($tagName) {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Element.tpl', 'php');
		$this->tagName = $tagName;
		$this->content = '';
		$this->attributes = array();
	}

	/**
	 * Set the element content
	 *
	 * @param string $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * Get the element content
	 *
	 * @return string
	 */
	public function getContent() {
		return trim($this->content);
	}

	/**
	 * Set the element attributes
	 *
	 * @param array $attributes
	 */
	public function setAttributes(array $attributes) {
		foreach ($attributes as $name => $value) {
			$this->setAttribute($name, $value);
		}
	}

	/**
	 * Set the element attribute
	 *
	 * @param string $name attribute name
	 * @param string $value attribute value
	 */
	public function setAttribute($name, $value) {
		$name = strtolower($name);
		$this->attributes[$name] = $value;
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
	 * Get the element attribute
	 *
	 * @param string $name
	 * @return string
	 */
	public function getAttribute($name) {
		$name = strtolower($name);
		return isset($this->attributes[$name]) ? $this->attributes[$name] : NULL;
	}

	/**
	 * Return if the element has a content or not
	 *
	 * @return bool
	 */
	public function isEmpty() {
		return $this->getContent() === '';
	}

	public function __toString() {
		$this->setVar('TAG_NAME', $this->tagName);
		$this->setVar('CONTENT', $this->content);
		if ($this->getTemplateType() == 'php') {
			$this->setVar('ATTRIBUTES', $this->attributes);
		}
		return parent::__toString();
	}

}
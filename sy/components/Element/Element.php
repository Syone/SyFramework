<?php
namespace Sy\Html;
use Sy\WebComponent;

class Element extends WebComponent {

	private $tagName;
	private $content;
	private $attributes;

	public function __construct($tagName = '') {
		parent::__construct();
		$this->setTemplateFile(dirname(__FILE__) . '/Element.tpl', 'php');
		$this->tagName = $tagName;
		$this->content = NULL;
		$this->attributes = array();
	}

	/**
	 * Set the element tag name
	 *
	 * @param string $tagName
	 */
	public function setTagName($tagName) {
		$this->tagName = $tagName;
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
		return $this->content;
	}

	/**
	 * Set the element attributes
	 *
	 * @param array $attributes
	 */
	public function setAttributes($attributes) {
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
		return isset($this->attributes[$name]) ? $this->attributes[$name] : NULL;
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
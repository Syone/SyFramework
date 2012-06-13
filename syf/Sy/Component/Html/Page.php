<?php
namespace Sy\Component\Html;

use Sy\Component;
use Sy\Component\WebComponent;

class Page extends WebComponent {

	private $debug;
	private $doctype;
	private $charset;
	private $meta;
	private $htmlAttributes;
	private $bodyAttributes;

	public function __construct() {
		$this->timeStart('Web page');
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/Page/templates/Page.tpl', 'php');
		$this->debug   = false;
		$this->doctype = 'html5';
		$this->charset = 'utf-8';
		$this->meta    = array();
		$this->htmlAttributes = array();
		$this->bodyAttributes = array();
		$this->setBody('');
	}

	/**
	 * Activate the web debug toolbar
	 */
	public function enableDebugBar() {
		$this->debug = true;
	}

	/**
	 * Set html tag attribute
	 *
	 * @param string $name attribute name
	 * @param string $value attribute value
	 */
	public function setHtmlAttribute($name, $value) {
		$this->htmlAttributes[$name] = $value;
	}

	/**
	 * Set html tag attributes
	 *
	 * @param array $attributes
	 */
	public function setHtmlAttributes(array $attributes) {
		foreach ($attributes as $name => $value) {
			$this->setHtmlAttribute($name, $value);
		}
	}

	/**
	 * Set the doctype declaration
	 *
	 * @param string $type [html4.01|xhtml1.0|xhtml1.1]-[strict|transitional|frameset]
	 */
	public function setDoctype($type = 'html5') {
		$this->doctype = $type;

		$doctype = array(
			'html4.01-strict'       => 'PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"',
			'html4.01-transitional' => 'PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"',
			'html4.01-frameset'     => 'PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"',
			'xhtml1.0-strict'       => 'PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"',
			'xhtml1.0-transitional' => 'PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"',
			'xhtml1.0-frameset'     => 'PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd"',
			'xhtml1.1'              => 'PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"',
			'html5'                 => '',
		);

		// Default doctype
		if (!array_key_exists($type, $doctype)) return;

		$this->setVar('DOCTYPE', $doctype[$type]);

		// xmlns attribute required for xhtml document
		if (strpos($type, 'xhtml') === 0)
			$this->setHtmlAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
	}

	/**
	 * Add a meta tag
	 *
	 * @param array $meta
	 */
	private function addMeta(array $meta) {
		$values = array_values($meta);
		$key    = strtolower($values[0]);
		$this->meta[$key] = $meta;
	}

	/**
	 * Set a meta tag
	 *
	 * @param string $name
	 * @param string $content
	 * @param bool   $httpEquiv
	 */
	public function setMeta($name, $content, $httpEquiv = false) {
		if ($httpEquiv)
			$this->addMeta(array('http-equiv' => $name, 'content' => $content));
		else
			$this->addMeta(array('name' => $name, 'content' => $content));
	}

	/**
	 * Set the document charset
	 *
	 * @param string $charset Charset encoding string
	 */
	public function setCharset($charset) {
		$this->charset = $charset;
	}

	/**
	 * Set the page description
	 *
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->setMeta('Description', $description);
	}

	/**
	 * Set the page title
	 *
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->setVar('TITLE', $title);
	}

	/**
	 * Set the page favicon
	 *
	 * @param string $href
	 * @param string $type
	 * @param string $rel
	 */
	public function setFavicon($href, $type = 'image/x-icon', $rel = 'shortcut icon') {
		$this->setVar('FAVICON_HREF', $href);
		$this->setVar('FAVICON_TYPE', $type);
		$this->setVar('FAVICON_REL', $rel);
	}

	/**
	 * Set body tag attribute
	 *
	 * @param string $name attribute name
	 * @param string $value attribute value
	 */
	public function setBodyAttribute($name, $value) {
		$this->bodyAttributes[$name] = $value;
	}

	/**
	 * Set the body tag attributes
	 *
	 * @param array $attributes
	 */
	public function setBodyAttributes(array $attributes) {
		foreach ($attributes as $name => $value) {
			$this->setBodyAttribute($name, $value);
		}
	}

	/**
	 * Set the body content
	 *
	 * @param mixed $content
	 */
	public function setBody($content) {
		if ($content instanceof Component)
			$this->setComponent('BODY', $content);
		else
			$this->setVar('BODY', $content);
	}

	/**
	 * Add a body content
	 *
	 * @param mixed $content
	 */
	public function addBody($content) {
		if ($content instanceof Component)
			$this->setComponent('BODY', $content, true);
		else
			$this->setVar('BODY', $content, true);
	}

	public function __toString() {
		$this->setVar('HTML_ATTR', $this->htmlAttributes);
		if ($this->doctype === 'html5')
			$this->addMeta(array('charset' => $this->charset));
		else
			$this->setMeta('Content-Type', 'text/html; charset=' . $this->charset, true);
		$this->setVar('META', $this->meta);
		$this->setVar('CSS_LINKS', $this->getCssLinks());
		$jsLinks = $this->getJsLinks();
		$this->setVar('JS_LINKS', $jsLinks[WebComponent::JS_TOP]);
		$this->setVar('JS_LINKS_BOTTOM', $jsLinks[WebComponent::JS_BOTTOM]);
		$this->setVar('CSS_CODE', $this->getCssCode());
		$this->setVar('JS_CODE', $this->getJsCode(WebComponent::JS_TOP));
		$this->setVar('JS_CODE_BOTTOM', $this->getJsCode(WebComponent::JS_BOTTOM));
		$this->setVar('BODY_ATTR', $this->bodyAttributes);
		$this->timeStop('Web page');
		if ($this->debug) {
			$this->setComponent('DEBUG_BAR', new Page\DebugBar($this->charset));
		}
		return parent::__toString();
	}

}
<?php
namespace Sy;

class WebPage extends WebComponent {

	private $meta;
	private $htmlAttributes;
	private $bodyAttributes;

	public function  __construct() {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/WebPage.tpl', 'php');
		$this->meta = array();
		$this->htmlAttributes = array();
		$this->bodyAttributes = array();
		$this->setCharset();
		$this->setBody('');
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
	public function setHtmlAttributes($attributes) {
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
		$doctype = Array(
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
		if (strpos($type, 'xhtml') === 0 )
			$this->setHtmlAttribute ('xmlns', 'http://www.w3.org/1999/xhtml');
	}

	/**
	 * Add a meta tag
	 *
	 * @param array $meta
	 */
	private function addMeta($meta) {
		$key = isset($meta['http-equiv']) ? $meta['http-equiv'] : $meta['name'];
		$key = strtolower($key);
		$this->meta[$key] = $meta;
	}

	/**
	 * Set a meta tag
	 *
	 * @param string $name
	 * @param string $content
	 * @param bool $http_equiv
	 */
	public function setMeta($name, $content, $http_equiv = false) {
		if ($http_equiv)
			$this->addMeta(array('http-equiv' => $name, 'content' => $content));
		else
			$this->addMeta(array('name' => $name, 'content' => $content));
	}

	/**
	 * Set the document charset
	 *
	 * @param string $charset Charset encoding string
	 */
	public function setCharset($charset = 'utf-8') {
		$this->setMeta('Content-Type', 'text/html; charset=' . $charset, true);
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
	public function setBodyAttributes($attributes) {
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

	public function  __toString() {
		$this->setVar('HTML_ATTR', $this->htmlAttributes);
		$this->setVar('META', $this->meta);
		$this->setVar('CSS_LINKS', $this->getCssLinks());
		$this->setVar('JS_LINKS', $this->getJsLinks());
		$css_code = $this->getCssCode();
		if (!empty($css_code)) $this->setVar('CSS_CODE', $css_code);
		$js_code = $this->getJsCode();
		if (!empty($js_code)) $this->setVar('JS_CODE', $js_code);
		$this->setVar('BODY_ATTR', $this->bodyAttributes);
		return parent::__toString();
	}
}
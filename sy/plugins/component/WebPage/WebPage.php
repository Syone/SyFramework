<?php
namespace Sy;

class WebPage extends WebComponent {

	private $bodyAttributes;

	public function  __construct() {
		parent::__construct();
		$this->usePhpTemplate();
		$this->setTemplateRoot(__DIR__);
		$this->setTemplateFile('WebPage.tpl');
		$this->setDoctype();
		$this->setCharset();
		$this->bodyAttributes = array();
		$this->setVar('BODY', '');
	}

	/**
	 * Sets the doctype declaration
	 *
	 * @param string $type
	 */
	public function setDoctype($type = 'html5') {
		$doctype = Array(
			'html4.01-strict' =>
			'<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"'."\n\t".
				'"http://www.w3.org/TR/html4/strict.dtd">',

			'html4.01-transitional' =>
			'<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"'."\n\t".
				'"http://www.w3.org/TR/html4/loose.dtd">',

			'xhtml1.0-strict' =>
			'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"'."\n\t".
				'"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',

			'xhtml1.0-transitional' =>
			'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'."\n\t".
				'"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',

			'html5' => '<!DOCTYPE html>',
		);

		// Default doctype
		if (!array_key_exists($type, $doctype)) $type = 'html5';

		$this->setVar('DOCTYPE', $doctype[$type] . "\n");

		// xmlns attribute required for xhtml document
		if (strpos($type, 'xhtml') === 0 )
			$this->setVar('XMLNS', 'http://www.w3.org/1999/xhtml');
	}

	/**
	 * Sets the document charset
	 *
	 * @param string $charset Charset encoding string
	 */
	public function setCharset($charset = 'utf-8') {
		$this->setVar('CHARSET', $charset);
	}

	/**
	 * Sets the page title
	 *
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->setVar('TITLE', $title);
	}

	public function setDescription($text) {
		$this->setVar('DESCRIPTION', $text);
	}

	public function setFavicon($href, $type = 'image/x-icon', $rel = 'shortcut icon') {
		$this->setVar('FAVICON_HREF', $href);
		$this->setVar('FAVICON_TYPE', $type);
		$this->setVar('FAVICON_REL', $rel);
	}

	/**
	 * Sets the body tag attributes
	 *
	 * @param array $attributes
	 */
	public function setBodyAttributes($attributes) {
		$this->bodyAttributes = $attributes;
	}

	public function setBody($content) {
		$this->setVar('BODY', $content);
	}

	public function addBody($content) {
		$this->setVar('BODY', $content, true);
	}

	public function  __toString() {
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
?>
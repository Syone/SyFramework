<?php
namespace Sy\Component;

use Sy\Component;
use Sy\Translate\TranslatorProvider;

class WebComponent extends Component {

	const JS_TOP    = 0;
	const JS_BOTTOM = 1;

	private $cssLinks;
	private $jsLinks;

	private $cssCode;
	private $jsCode;

	private $translators;

	public function __construct() {
		parent::__construct();
		$this->cssLinks = array();
		$this->jsLinks  = array(self::JS_TOP => array(), self::JS_BOTTOM => array());
		$this->cssCode  = array();
		$this->jsCode   = array(self::JS_TOP => array(), self::JS_BOTTOM => array());
		$this->translators = array();
	}

	/**
	 * Add a component
	 *
	 * @param string $where
	 * @param Component $component
	 * @param boolean $append
	 */
	public function setComponent($where, Component $component, $append = false) {
		parent::setComponent($where, $component, $append);
		if (!$component instanceof WebComponent) return;
		$this->mergeCss($component);
		$this->mergeJs($component);
	}

	/**
	 * Merge css code and links from a WebComponent
	 *
	 * @param WebComponent $component
	 */
	public function mergeCss(WebComponent $component) {
		$this->cssLinks = array_merge_recursive($this->cssLinks, $component->getCssLinks());
		$this->cssCode  = array_merge($this->cssCode, $component->getCssCodeArray());
	}

	/**
	 * Merge js code and links from a WebComponent
	 *
	 * @param WebComponent $component
	 */
	public function mergeJs(WebComponent $component) {
		$jsLinks = $component->getJsLinks();
		$jsCode  = $component->getJsCodeArray();
		$this->jsLinks[self::JS_TOP]    = array_merge($this->jsLinks[self::JS_TOP]   , $jsLinks[self::JS_TOP]);
		$this->jsLinks[self::JS_BOTTOM] = array_merge($this->jsLinks[self::JS_BOTTOM], $jsLinks[self::JS_BOTTOM]);
		$this->jsCode[self::JS_TOP]     = array_merge($this->jsCode[self::JS_TOP]    , $jsCode[self::JS_TOP]);
		$this->jsCode[self::JS_BOTTOM]  = array_merge($this->jsCode[self::JS_BOTTOM] , $jsCode[self::JS_BOTTOM]);
	}

	/**
	 * Return the css code array
	 *
	 * @return string
	 */
	public function getCssCodeArray() {
		return $this->cssCode;
	}

	/**
	 * Return the js code array
	 *
	 * @return string
	 */
	public function getJsCodeArray() {
		return $this->jsCode;
	}

	/**
	 * Return the css code
	 *
	 * @return string
	 */
	public function getCssCode() {
		$res = array_unique($this->cssCode);
		return implode("\n", $res);
	}

	/**
	 * Return the js code
	 *
	 * @return string
	 */
	public function getJsCode($position = self::JS_TOP) {
		$res = array_unique($this->jsCode[$position]);
		return implode("\n", $res);
	}

	/**
	 * Add the css code
	 *
	 * @param string $code
	 */
	public function addCssCode($code) {
		$this->cssCode[] = $code;
	}

	/**
	 * Add the js code
	 *
	 * @param string $code
	 * @param int $position \Sy\Component\WebComponent::JS_TOP or \Sy\Component\WebComponent::JS_BOTTOM
	 */
	public function addJsCode($code, $position = self::JS_TOP) {
		if ($position === self::JS_BOTTOM)
			$this->jsCode[self::JS_BOTTOM][] = $code;
		else
			$this->jsCode[self::JS_TOP][] = $code;
	}

	/**
	 * Add a css link
	 *
	 * @param string $url
	 * @param string $media
	 */
	public function addCssLink($url, $media = '') {
		$this->cssLinks[$media][] = $url;
	}

	/**
	 * Add a js link
	 *
	 * @param string $url
	 * @param int $position \Sy\Component\WebComponent::JS_TOP or \Sy\Component\WebComponent::JS_BOTTOM
	 */
	public function addJsLink($url, $position = self::JS_TOP) {
		if ($position === self::JS_BOTTOM)
			$this->jsLinks[self::JS_BOTTOM][] = $url;
		else
			$this->jsLinks[self::JS_TOP][] = $url;
	}

	/**
	 * Get the css links
	 *
	 * @return array
	 */
	public function getCssLinks() {
		foreach ($this->cssLinks as $media => $links) {
			$this->cssLinks[$media] = array_unique($links);
		}
		return $this->cssLinks;
	}

	/**
	 * Get the js links
	 *
	 * @return array
	 */
	public function getJsLinks() {
		$this->jsLinks[self::JS_TOP] = array_unique($this->jsLinks[self::JS_TOP]);
		$this->jsLinks[self::JS_BOTTOM] = array_unique($this->jsLinks[self::JS_BOTTOM]);
		return $this->jsLinks;
	}

	/**
	 * Add a Translator
	 *
	 * @param string $directory Translator directory
	 * @param string $type Translator type
	 */
	public function addTranslator($directory, $type = 'php') {
		$this->translators[] = TranslatorProvider::createTranslator($directory, $type);
	}

	/**
	 * Translate message
	 *
	 * @param string $message
	 * @return string
	 */
	public function _($message) {
		$res = '';
		foreach ($this->translators as $translator) {
			$res = $translator->translate($message);
			if (!empty($res)) break;
		}
		return $res;
	}

	public function __toString() {
		foreach ($this->translators as $translator) {
			$this->setVars($translator->getTranslationData());
		}
		return parent::__toString();
	}

}
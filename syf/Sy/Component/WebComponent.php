<?php
namespace Sy\Component;

use Sy\Component;

class WebComponent extends Component {

	const JS_TOP    = 0;
	const JS_BOTTOM = 1;

	private $cssLinks;
	private $jsLinks;
	private $jsLinksBottom;

	private $cssCode;
	private $jsCode;
	private $jsCodeBottom;

	public function __construct() {
		parent::__construct();
		$this->cssLinks      = array();
		$this->jsLinks       = array();
		$this->jsLinksBottom = array();
		$this->cssCode       = array();
		$this->jsCode        = array();
		$this->jsCodeBottom  = array();
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
		$this->jsLinks       = array_merge($this->jsLinks, $component->getJsLinks());
		$this->jsLinksBottom = array_merge($this->jsLinksBottom, $component->getJsLinksBottom());
		$this->jsCode        = array_merge($this->jsCode, $component->getJsCodeArray());
		$this->jsCodeBottom  = array_merge($this->jsCodeBottom, $component->getJsCodeArrayBottom());
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
	 * Return the js code array
	 *
	 * @return string
	 */
	public function getJsCodeArrayBottom() {
		return $this->jsCodeBottom;
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
	public function getJsCode() {
		$res = array_unique($this->jsCode);
		return implode("\n", $res);
	}

	/**
	 * Return the js code
	 *
	 * @return string
	 */
	public function getJsCodeBottom() {
		$res = array_unique($this->jsCodeBottom);
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
	 * @param int $position Sy\Component\WebComponent::JS_TOP or Sy\Component\WebComponent::JS_BOTTOM
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
	 * @param string $position 'top' or 'bottom'
	 */
	public function addJsLink($url, $position = 'top') {
		if ($position === 'bottom')
			$this->jsLinksBottom[] = $url;
		else
			$this->jsLinks[] = $url;
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
		$this->jsLinks = array_unique($this->jsLinks);
		return $this->jsLinks;
	}

	/**
	 * Get the js links (bottom)
	 *
	 * @return array
	 */
	public function getJsLinksBottom() {
		$this->jsLinksBottom = array_unique($this->jsLinksBottom);
		return $this->jsLinksBottom;
	}

}
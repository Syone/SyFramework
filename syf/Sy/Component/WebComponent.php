<?php
namespace Sy\Component;
use Sy\Component;

class WebComponent extends Component {

	private $cssLinks;
	private $jsLinks;

	private $cssCode;
	private $jsCode;

	public function __construct() {
		parent::__construct();
		$this->cssLinks = array();
		$this->jsLinks  = array();
		$this->cssCode  = array();
		$this->jsCode   = array();
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
		$this->jsLinks  = array_merge($this->jsLinks, $component->getJsLinks());
		$this->jsCode   = array_merge($this->jsCode, $component->getJsCodeArray());
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
	public function getJsCode() {
		$res = array_unique($this->jsCode);
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
	 */
	public function addJsCode($code) {
		$this->jsCode[] = $code;
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
	 */
	public function addJsLink($url) {
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

}
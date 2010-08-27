<?php
namespace Sy;

class WebComponent extends Component {

	protected $cssLinks;
	protected $jsLinks;

	protected $cssCode;
	protected $jsCode;

	public function __construct() {
		parent::__construct();
		$this->cssLinks = array();
		$this->jsLinks = array();
		$this->cssCode = '';
		$this->jsCode = '';
	}

	/**
	 * Add a component
	 *
	 * @param string $where
	 * @param Component $component
	 * @param boolean $append
	 */
	public function setComponent($where, $component, $append = false) {
		parent::setComponent($where, $component, $append);
		$this->cssLinks = array_merge($this->cssLinks, $component->getCssLinks());
		$this->jsLinks = array_merge($this->jsLinks, $component->getJsLinks());
		$this->cssCode .= $component->getCssCode();
		$this->jsCode .= $component->getJsCode();
	}

	/**
	 * Return the css code
	 *
	 * @return string
	 */
	public function getCssCode() {
		return $this->cssCode;
	}

	/**
	 * Return the js code
	 *
	 * @return string
	 */
	public function getJsCode() {
		return $this->jsCode;
	}

	/**
	 * Set the css code
	 *
	 * @param string $code
	 */
	public function setCssCode($code) {
		$this->cssCode = $code;
	}

	/**
	 * Set the js code
	 *
	 * @param string $code
	 */
	public function setJsCode($code) {
		$this->jsCode = $code;
	}

	/**
	 * Add a css link
	 *
	 * @param string $url
	 */
	public function addCssLink($url) {
		$this->cssLinks[] = $url;
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
		$this->cssLinks = array_unique($this->cssLinks);
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
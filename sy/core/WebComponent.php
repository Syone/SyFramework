<?php
namespace Sy;

class WebComponent extends Component {

	/**
	 *
	 * @var Component
	 */
	protected $cssComponent;

	/**
	 *
	 * @var Component
	 */
	protected $jsComponent;

	protected $cssLinks;
	protected $jsLinks;

	public function __construct() {
		parent::__construct();
		$this->cssComponent = new Component();
		$this->jsComponent = new Component();
		$this->cssLinks = array();
		$this->jsLinks = array();
	}

	public function setComponent($where, $component, $append = false) {
		parent::setComponent($where, $component, $append);
		$this->cssLinks = array_merge($this->cssLinks, $component->getCssLinks());
		$this->jsLinks = array_merge($this->jsLinks, $component->getJsLinks());
	}

	/**
	 *
	 * @return Component
	 */
	public function getCss() {
		return $this->cssComponent;
	}

	/**
	 *
	 * @return Component
	 */
	public function getJs() {
		return $this->jsComponent;
	}

	public function addCssLink($url) {
		$this->cssLinks[] = $url;
	}

	public function addJsLink($url) {
		$this->jsLinks[] = $url;
	}

	public function getCssLinks() {
		$this->cssLinks = array_unique($this->cssLinks);
		return $this->cssLinks;
	}

	public function getJsLinks() {
		$this->jsLinks = array_unique($this->jsLinks);
		return $this->jsLinks;
	}

	public function getCssLinksHtml() {
		$res = array_map(array($this, 'cssLinkToHtml'), $this->getCssLinks());
		return implode($res);
	}

	public function getJsLinksHtml() {
		$res = array_map(array($this, 'jsLinkToHtml'), $this->getJsLinks());
		return implode($res);
	}

	private function cssLinkToHtml($url) {
		return '<link rel="stylesheet" href="'.$url.'" type="text/css" />';
	}

	private function jsLinkToHtml($url) {
		return '<script type="text/javascript" src="'.$url.'"></script>';
	}
}
?>

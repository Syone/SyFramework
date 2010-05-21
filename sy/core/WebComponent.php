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

	public function setComponent($where, $component, $append = false) {
		parent::setComponent($where, $component, $append);
		$this->cssLinks = array_merge($this->cssLinks, $component->getCssLinks());
		$this->jsLinks = array_merge($this->jsLinks, $component->getJsLinks());
		$this->cssCode .= $component->getCssCode();
		$this->jsCode .= $component->getJsCode();
	}

	public function getCssCode() {
		return $this->cssCode;
	}

	public function getJsCode() {
		return $this->jsCode;
	}

	public function setCssCode($code) {
		$this->cssCode = $code;
	}

	public function setJsCode($code) {
		$this->jsCode = $code;
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

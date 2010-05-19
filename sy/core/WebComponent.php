<?php
namespace Sy;

class WebComponent extends Component {

	protected $cssComponent;
	protected $jsComponent;

	protected $cssLinks;
	protected $jsLinks;

	public function __construct() {
		parent::__construct();
		$this->cssComponent = new Component();
		$this->jsComponent = new Component();
		$this->cssLink = array();
		$this->jsLink = array();
	}

	public function addCssLink($url) {
		$this->cssLinks[] = $url;
	}

	public function addJsLink($url) {
		$this->jsLinks[] = $url;
	}

	public function getCssLinks() {
		return $this->cssLinks;
	}

	public function getJsLinks() {
		return $this->jsLinks;
	}

	

	protected function cssLinkToHtml($url) {
		return '<link rel="stylesheet" href="'.$url.'" type="text/css" />'."\n";
	}

	protected function jsLinkToHtml($url) {
		return '<script type="text/javascript" src="'.$url.'"></script>'."\n";
	}
}
?>

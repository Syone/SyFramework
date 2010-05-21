<?php
use Sy\WebComponent;

class WebPage extends WebComponent {

	public function  __construct() {
		parent::__construct();
		$this->usePhpTemplate();
		$this->setTemplateRoot(__DIR__);
		$this->setTemplateFile('WebPage.tpl');
		$this->setDoctype();
		$this->setVar('CSS_LINKS', '');
		$this->setVar('JS_LINKS', '');
		$this->setVar('BODY', '');
	}

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

		// DOCTYPE par défaut si le DOCTYPE souhaité n'existe pas
		if (!array_key_exists($type, $doctype)) $type = 'html5';

		$this->setVar('DOCTYPE', $doctype[$type] . "\n");

		// La plupart des documents basé sur XML nécessite l'attribut xmlns=""
		if (strpos($type, 'xhtml') === 0 )
			$this->setVar('XMLNS', ' xmlns="http://www.w3.org/1999/xhtml"');
	}

	public function setTitle($title) {
		$this->setVar('TITLE', $title);
	}

	public function setDescription($text) {
		$this->setVar('DESCRIPTION', $text);
	}

	public function setFavicon($icon) {
		$this->setVar('FAVICON', $icon);
	}

	public function  __toString() {
		$this->setVar('CSS_LINKS', $this->getCssLinksHtml());
		$this->setVar('JS_LINKS', $this->getJsLinksHtml());
		$css_code = $this->getCssCode();
		if (!empty($css_code)) $this->setVar('CSS_CODE', $css_code);
		$js_code = $this->getJsCode();
		if (!empty($js_code)) $this->setVar('JS_CODE', $js_code);
		return parent::__toString();
	}
}
?>

<?php
namespace Sy\Template;

class PhpTemplate implements ITemplate {

	private $mainFile;

	private $vars;

	public function __construct() {
		$this->mainFile = '';
		$this->vars = array();
		$this->files = array();
	}

	public function setMainFile($file) {
		if (file_exists($file)) $this->mainFile = $file;
	}

	public function setVar($var, $value, $append = false) {
		if ($append and isset($this->vars[$var]))
			$this->vars[$var] .= $value;
		else
			$this->vars[$var] = $value;
	}

	public function setBlock($block) {

	}

	public function getRender() {
		if (empty($this->mainFile)) return '';

		foreach ($this->vars as $name => $value) {
			$$name = $value;
		}

		ob_start();
		include $this->mainFile;
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

}
<?php
namespace Sy\Template;

class PhpTemplate implements ITemplate {

	private $file;

	private $vars;

	private $blocks;

	public function __construct() {
		$this->file = '';
		$this->vars = array();
		$this->blocks = array();
	}

	public function setFile($file) {
		if (file_exists($file)) $this->file = $file;
	}

	public function setVar($var, $value, $append = false) {
		if ($append and isset($this->vars[$var]))
			$this->vars[$var] .= $value;
		else
			$this->vars[$var] = $value;
	}

	public function setBlock($block) {
		$this->blocks[$block][] = $this->vars;
	}

	public function _($var) {
		return isset($this->vars[$var]) ? $this->vars[$var] : $var;
	}

	public function getRender() {
		if (empty($this->file)) return '';

		extract($this->blocks);
		extract($this->vars);

		$this->blocks = array();
		$this->vars = array();

		ob_start();
		include $this->file;
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

}
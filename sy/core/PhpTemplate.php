<?php
namespace Sy;

class PhpTemplate implements ITemplate {

	private $mainFile;

	private $files;

	private $vars;

	public function  __construct() {
		$this->mainFile = '';
		$this->vars = array();
		$this->files = array();
	}

	public function setMainFile($file) {
		$this->mainFile = $file;
	}

	public function setFile($var, $file) {
		$this->files[$var] = $file;
	}

	public function setVar($var, $value, $append = false) {
		if ($append)
			$this->vars[$var] .= $value;
		else
			$this->vars[$var] = $value;
	}

	public function parseBlock($block) {

	}

	public function getRender() {
		if (empty($this->mainFile)) return '';

		$this->renderFiles();

		foreach ($this->vars as $name => $value) {
			$$name = $value;
		}

		ob_start();
		include $this->mainFile;
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	private function renderFiles() {

		if (empty($this->files)) return;

		foreach ($this->vars as $name => $value) {
			$$name = $value;
		}

		foreach ($this->files as $name => $file) {
			ob_start();
			include $file;
			$content = ob_get_contents();
			ob_end_clean();
			$this->setVar($name, $content);
		}
	}
}
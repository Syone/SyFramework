<?php
namespace Sy;

class PhpTemplate implements ITemplate {

	private $root;

	private $mainFile;

	private $files;

	private $vars;

	public function  __construct() {
		$this->root = '';
		$this->mainFile = '';
		$this->vars = array();
		$this->files = array();
	}

	public function setRoot($path) {
		$this->root = rtrim($path, '/\\');
	}

	public function setTemplateFile($fileName) {
		$this->mainFile = empty($this->root) ? $fileName : $this->root . '/' . $fileName;
	}

	public function setFile($var, $fileName) {
		$this->files[$var] = empty($this->root) ? $fileName : $this->root . '/' . $fileName;
	}

	public function setVar($var, $value, $append = false) {
		if ($append)
			$this->vars[$var] .= $value;
		else
			$this->vars[$var] = $value;
	}

	public function parseBlock($blockName) {

	}

	public function getRender() {
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
?>
<?php
namespace Sy;

class Template implements ITemplate {

	private $root;

	private $content;

	private $vars;

	public function  __construct($root = '.') {
		$this->setRoot($root);
		$this->content = '';
		$this->vars = array();
	}

	public function setRoot($path) {
		$this->root = rtrim($path, '/\\');
	}

	public function setTemplateFile($fileName) {
		$this->content = file_get_contents($this->root . '/' . $fileName);
	}

	public function setFile($var, $fileName, $append = false) {
		$this->content = str_replace('{' . $var . '}', file_get_contents($this->root . '/' . $fileName), $this->content);
	}

	public function setVar($var, $value, $append = false) {
		if ($append)
			$this->vars['{' . $var . '}'] .= $value;
		else
			$this->vars['{' . $var . '}'] = $value;
	}

	public function setBlock($block) {
		
	}

	public function getRender() {
		$res =  str_replace(array_keys($this->vars), array_values($this->vars), $this->content);
		$res = preg_replace('/{[^ \t\r\n}]+}/', "", $res);
		return $res;
	}
	
}
?>

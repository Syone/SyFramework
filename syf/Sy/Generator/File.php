<?php
namespace Sy\Generator;

class File {

	private $name;
	private $content;

	public function __construct($name, $content = '') {
		$this->name = $name;
		$this->content = $content;
	}

	public function generate() {
		$dir = dirname($this->name);
		if (!file_exists($dir)) mkdir($dir, '0777', true);
		file_put_contents($this->name, $this->content);
	}

}
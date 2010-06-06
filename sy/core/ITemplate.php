<?php
namespace Sy;

interface ITemplate {

	public function getRoot();

	public function setRoot($path);

	public function setMainFile($file);

	public function setFile($var, $file);

	public function setVar($var, $value, $append = false);

	public function parseBlock($block);

	public function getRender();
	
}
?>

<?php
namespace Sy;

interface ITemplate {

	public function setRoot($path);

	public function setTemplateFile($fileName);

	public function setFile($var, $fileName);

	public function setVar($var, $value, $append = false);

	public function parseBlock($blockName);

	public function getRender();
	
}
?>

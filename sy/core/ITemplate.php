<?php
namespace Sy;

interface ITemplate {

	public function setRoot($path);

	public function setTemplateFile($fileName);

	public function setFile($var, $fileName, $append = false);

	public function setVar($var, $value, $append = false);

	public function getRender();
	
}
?>

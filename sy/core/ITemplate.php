<?php
namespace Sy;

interface ITemplate {

	public function setRoot($path);

	public function setTemplateFile($fileName);

	public function setVar($var, $value, $append = false);

	public function getRender();
	
}
?>

<?php
namespace Sy\Template;

interface ITemplate {

	public function setMainFile($file);

	public function setVar($var, $value, $append = false);

	public function setBlock($block);

	public function getRender();
	
}
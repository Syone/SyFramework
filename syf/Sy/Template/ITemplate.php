<?php
namespace Sy\Template;

interface ITemplate {

	public function setFile($file);

	public function setVar($var, $value, $append = false);

	public function setBlock($block);

	public function getRender();

}
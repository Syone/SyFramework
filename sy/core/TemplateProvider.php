<?php
namespace Sy;

class TemplateProvider {

	/**
	 * Return a new ITemplate object
	 *
	 * @return ITemplate
	 */
	public static function createTemplate($type = '') {
		$type = ucfirst(strtolower($type));
		$class = 'Sy\\' . $type . 'Template';
		if (!\class_exists($class)) $class = 'Sy\Template';
		return new $class();
	}
	
}
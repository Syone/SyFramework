<?php
namespace Sy;

class TemplateProvider {

	/**
	 * Return a new ITemplate object
	 *
	 * @return ITemplate
	 */
	public static function createTemplate($type = '') {
		$type = strtolower($type);
		$type = ucfirst($type);
		$class = 'Sy\\' . $type . 'Template';
		return new $class();
	}
	
}
<?php
namespace Sy\Template;

class TemplateProvider {

	/**
	 * Return a new ITemplate object
	 *
	 * @return ITemplate
	 */
	public static function createTemplate($type = '') {
		$type = ucfirst(strtolower($type));
		$class = 'Sy\\Template\\' . $type . 'Template';
		if (!class_exists($class)) $class = 'Sy\\Template\\Template';
		return new $class();
	}

}
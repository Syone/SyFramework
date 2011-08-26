<?php
namespace Sy\Template;

class TemplateProvider {

	/**
	 * Return a new ITemplate object
	 *
	 * @param string $type
	 * @return ITemplate
	 */
	public static function createTemplate($type = '') {
		$type = ucfirst(strtolower($type));
		$class = __NAMESPACE__ . '\\' . $type . 'Template';
		if (!class_exists($class)) $class = __NAMESPACE__ . '\\Template';
		return new $class();
	}

}
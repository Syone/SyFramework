<?php
namespace Sy;

class TemplateProvider {

	/**
	 * Return a new ITemplate object
	 *
	 * @return ITemplate
	 */
	public static function createTemplate($type = '') {
		$class = 'Sy\\' . $type . 'Template';
		return new $class();
	}
	
}
?>

<?php
namespace Sy;

class TemplateProvider {

	/**
	 * Return a new ITemplate object
	 *
	 * @return ITemplate
	 */
	public static function createTemplate() {
		//return new PhpLibTemplate();
		return new Template();
	}
	
}
?>

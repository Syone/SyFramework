<?php
namespace Sy\Translator;

class TranslatorProvider {

	/**
	 * Return a new ITranslator object
	 *
	 * @return ITranslator
	 */
	public static function createTranslator($type = 'php') {
		$type = ucfirst(strtolower($type));
		$class = __NAMESPACE__ . '\\' . $type . 'Translator';
		if (!class_exists($class)) $class = __NAMESPACE__ . '\\Translator';
		return new $class();
	}

}
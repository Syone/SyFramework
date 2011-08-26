<?php
namespace Sy\Translate;

class TranslatorProvider {

	/**
	 * Return a new ITranslator object
	 *
	 * @param string $directory
	 * @param string $type
	 * @return ITranslator
	 */
	public static function createTranslator($directory, $type = 'php') {
		$type = ucfirst(strtolower($type));
		$class = __NAMESPACE__ . '\\' . $type . 'Translator';
		if (!class_exists($class)) $class = __NAMESPACE__ . '\\Translator';
		$langDetector = LangDetector::getInstance();
		$translator = new $class();
		$translator->setTranslationLang($langDetector->getLang());
		$translator->setTranslationDir($directory);
		$data = $translator->loadTranslationData();
		$translator->setTranslationData($data);
		return $translator;
	}

}
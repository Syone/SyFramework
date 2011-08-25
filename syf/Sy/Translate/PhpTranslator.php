<?php
namespace Sy\Translate;

class PhpTranslator extends Translator implements ITranslator {

	public function loadTranslationData() {
		$file = $this->getTranslationDir() . '/' . $this->getTranslationLang() . '.php';
		$data = include($file);
		if (!is_array($data)) $data = array();
		return $data;
	}

}
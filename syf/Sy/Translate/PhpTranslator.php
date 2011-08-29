<?php
namespace Sy\Translate;

class PhpTranslator extends Translator implements ITranslator {

	public function loadTranslationData() {
		$data = array();
		$file = $this->getTranslationDir() . '/' . $this->getTranslationLang() . '.php';
		if (file_exists($file)) $data = include($file);
		if (!is_array($data)) $data = array();
		$this->setTranslationData($data);
	}

}
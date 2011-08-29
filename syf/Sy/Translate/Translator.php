<?php
namespace Sy\Translate;

class Translator {

	private $translationData;

	private $translationLang;

	private $translationDir;

	public function getTranslationData() {
		return $this->translationData;
	}

	public function getTranslationLang() {
		return $this->translationLang;
	}

	public function getTranslationDir() {
		return $this->translationDir;
	}

	public function setTranslationData(array $data) {
		$this->translationData = $data;
	}

	public function setTranslationLang($lang) {
		$this->translationLang = $lang;
	}

	public function setTranslationDir($directory) {
		$this->translationDir = $directory;
	}

	public function translate($message) {
		return isset($this->translationData[$message]) ? $this->translationData[$message] : '';
	}

}
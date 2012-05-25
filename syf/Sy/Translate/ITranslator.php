<?php
namespace Sy\Translate;

interface ITranslator {

	public function getTranslationData();

	public function getTranslationLang();

	public function getTranslationDir();

	public function setTranslationData(array $data);

	public function setTranslationLang($lang);

	public function setTranslationDir($directory);

	public function translate($message);

	public function loadTranslationData();

}
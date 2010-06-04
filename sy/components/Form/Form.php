<?php
namespace Sy\Form;

function autoload($class) {
	$class = str_replace('\\', '/', $class);
	$class = basename($class);
	if (file_exists($file = __DIR__ . "/$class.php")) {
		require_once $file;
	}
}

spl_autoload_register("Sy\Form\autoload");


abstract class Form extends FieldContainer {

	public function __construct() {
		parent::__construct();
		$this->setTemplateFile('Form.tpl');
		$this->attributes = array(
			'action'  => '',
			'method'  => 'post',
		);
		$this->elements = array();
		$this->actionDispatch('formAction');
		$this->init();
	}

	public function setAttributes($attributes) {
		if (!isset($attributes['action'])) $attributes['action'] = '';
		$this->attributes = $attributes;
	}

	public function addFieldset($legend = NULL) {
		return $this->addElement(new Fieldset($legend));
	}

	abstract public function init();

	abstract public function actionPerform();

}
?>

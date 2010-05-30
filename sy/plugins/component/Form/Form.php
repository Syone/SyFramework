<?php
namespace Sy\Form;

function autoload($class) {
	$class = basename($class);
	if (file_exists($file = __DIR__ . "/$class.php")) {
		require_once $file;
	}
}

spl_autoload_register("Sy\Form\autoload");


abstract class Form extends Element {

	public function __construct() {
		parent::__construct();
		$this->usePhpTemplate();
		$this->setTemplateRoot(__DIR__ . '/templates');
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
		$fieldset = new Fieldset($legend);
		$this->addElement($fieldset);
		return $fieldset;
	}

	public function addInput($attributes, $options = array()) {
		$input = new Input();
		$input->setAttributes($attributes);
		$input->setOptions($options);
		$this->addElement($input);
	}

	abstract public function init();

	abstract public function actionPerform();

}
?>

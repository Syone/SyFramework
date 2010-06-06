<?php
namespace Sy\Form;

require __DIR__ . '/autoload.php';

abstract class Form extends FieldContainer {

	public function __construct() {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Form.tpl', 'php');
		$this->attributes = array(
			'action'  => '',
			'method'  => 'post',
		);
		$this->elements = array();
		$this->init();
		$this->actionDispatch('formAction');
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

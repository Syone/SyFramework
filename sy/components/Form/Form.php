<?php
namespace Sy\Form;

require __DIR__ . '/autoload.php';

abstract class Form extends FieldContainer {

	private static $instances = 0;

	private $formId = 0;

	public function __construct() {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Form.tpl', 'php');
		$this->attributes = array(
			'action'  => '',
			'method'  => 'post',
		);
		$this->elements = array();
		$this->formId = ++self::$instances;
		$this->init();
		$this->actionDispatch('formAction' . $this->formId);
	}

	public function setAttributes($attributes) {
		if (!isset($attributes['action'])) $attributes['action'] = '';
		$this->attributes = $attributes;
	}

	public function addFieldset($legend = NULL) {
		return $this->addElement(new Fieldset($legend));
	}

	public function __toString() {
		$actionElement = new Element('input');
		$actionElement->setAttributes(array('type' => 'hidden', 'name' => 'formAction' . $this->formId, 'value' => 'Perform' ));
		$this->setComponent('ACTION_ELEMENT', $actionElement);
		return parent::__toString();
	}

	abstract public function init();

	abstract public function actionPerform();

}
?>

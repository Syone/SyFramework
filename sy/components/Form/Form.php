<?php
namespace Sy\Form;

require __DIR__ . '/autoload.php';

abstract class Form extends FieldContainer {

	private static $instances = 0;

	protected $formId = 0;

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
		parent::setAttributes($attributes);
	}

	/**
	 * Add a fieldset element in the form
	 *
	 * @param string $legend the fieldset legend
	 * @return Fieldset
	 */
	public function addFieldset($legend = NULL) {
		return $this->addElement(new Fieldset($legend));
	}

	public function __toString() {
		$actionElement = new Hidden();
		$actionElement->setAttributes(array('name' => 'formAction' . $this->formId, 'value' => 'submit' ));
		$this->setComponent('ACTION_ELEMENT', $actionElement);
		return parent::__toString();
	}

	abstract public function init();

	abstract public function submitAction();

}
?>

<?php
namespace Sy\Form;

require __DIR__ . '/autoload.php';

abstract class Form extends FieldContainer {

	private static $instances = 0;

	protected $formId = 0;

	protected $success;

	public function __construct() {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Form.tpl', 'php');
		$this->formId = ++self::$instances;
		$this->attributes = array(
			'action'  => '',
			'method'  => 'post',
		);
		$this->elements = array();
		$this->success = false;
		$this->init();
		$this->actionDispatch('formAction' . $this->formId);
	}

	public function isValid($values) {
		$valid = parent::isValid($values);
		if ($valid) {
			$this->success = true;
		} else {
			$this->error = true;
		}
		return $valid;
	}

	public function __toString() {
		$this->setVar('SUCCESS', $this->success);
		$this->setVar('ACTION', 'formAction' . $this->formId);
		return parent::__toString();
	}

	abstract public function init();

	abstract public function submitAction();

}
?>

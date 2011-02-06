<?php
namespace Sy\Form;

require __DIR__ . '/autoload.php';

class Form extends FieldContainer {

	private static $instances = 0;

	private $formId = 0;

	private $success;

	public function __construct() {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/templates/Form.tpl', 'php');
		$this->formId = ++self::$instances;
		$this->setAttributes(array(
			'action'  => '',
			'method'  => 'post',
		));
		$this->success = false;
		$this->init();
		if ($this->request('formAction' . $this->formId) == 'submit') {
			$info['type'] = 'Form submit';
			$message = 'Call method ' . get_class($this) . ':submitAction';
			$this->log($message, $info);
			$this->submitAction();
		}
	}

	/**
	 * Validate the form
	 *
	 * @param array $values
	 * @return boolean
	 */
	public function isValid($values) {
		$valid = parent::isValid($values);
		if ($valid) {
			$this->success = true;
		} else {
			$this->setError(true);
		}
		return $valid;
	}

	public function __toString() {
		$this->setVar('SUCCESS', $this->success);
		$this->setVar('ACTION', 'formAction' . $this->formId);
		return parent::__toString();
	}

	public function init() {

	}

	public function submitAction() {

	}

}
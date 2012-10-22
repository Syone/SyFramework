<?php
namespace Sy\Component\Html;

class Form extends Form\FieldContainer {

	private static $instances = 0;

	private $formId = 0;

	public function __construct(array $attributes = array()) {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/Form/templates/Form.tpl', 'php');
		$this->formId = ++self::$instances;
		$this->setAttributes($attributes);
		$this->setOption('error-class', 'error');
		$this->setOption('success-class', 'success');
		$this->init();
		if ($this->request('formAction' . $this->formId) == 'submit') {
			$info = $this->getDebugTrace();
			$info['type'] = 'Form submit';
			$message = 'Call method ' . get_class($this) . '::submitAction';
			$this->log($message, $info);
			$this->submitAction();
		}
	}

	public function __toString() {
		if (is_null($this->getAttribute('action'))) {
			$this->setAttribute('action', $_SERVER['REQUEST_URI']);
			$this->setVar('ACTION', 'formAction' . $this->formId);
		}
		if (is_null($this->getAttribute('method'))) {
			$this->setAttribute('method', 'post');
		}
		return parent::__toString();
	}

	/**
	 * Set success message
	 *
	 * @param string $success
	 */
	public function setSuccess($success) {
		$this->setOption('success', $success);
	}

	/**
	 * Process form validation
	 *
	 * @param array $values
	 * @throws Form\Exception
	 */
	public function validate(array $values) {
		if (!$this->isValid($values)) {
			throw new Form\Exception;
		}
	}

	public function init() {

	}

	public function submitAction() {

	}

}

namespace Sy\Component\Html\Form;

class Exception extends \Exception {}
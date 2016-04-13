<?php
namespace Sy\Component\Html\Form;

class Textarea extends TextElement implements FillableElement {

	public function __construct() {
		parent::__construct('textarea');
		$this->setTemplateFile(__DIR__ . '/templates/Textarea.tpl', 'php');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setContent(array($value));
	}

	public function __toString() {
		$content = $this->getContent();
		if (empty($content)) {
			$content = is_null($this->getOption('content')) ? '' : $this->getOption('content');
			$this->addText($content);
		}
		return parent::__toString();
	}

}
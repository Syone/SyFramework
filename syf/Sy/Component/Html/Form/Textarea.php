<?php
namespace Sy\Component\Html\Form;

class Textarea extends TextElement implements FillableElement {

	public function __construct() {
		parent::__construct('textarea');
	}

	public function fill($value) {
		if (is_array($value)) return;
		$this->setContent($value);
	}

	public function __toString() {
		$content = $this->getContent();
		if (empty($content)) {
			$content = is_null($this->getOption('content')) ? '' : $this->getOption('content');
			$this->setContent($content);
		}
		return parent::__toString();
	}

}
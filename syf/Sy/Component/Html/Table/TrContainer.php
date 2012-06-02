<?php
namespace Sy\Component\Html\Table;

use Sy\Component\Html\Element;

/**
 * The tr element container
 */
class TrContainer extends Element {

	/**
	 * Add a tr element
	 *
	 * @param array $attributes tr element attributes
	 * @return Tr
	 */
	public function addTr(array $attributes = array()) {
		$element = new Tr();
		$element->setAttributes($attributes);
		return $this->addElement($element);
	}

	/**
	 * Return if all Tr contained is empty
	 *
	 * @return bool
	 */
	public function isEmpty() {
		$trs = $this->getContent();
		foreach ($trs as $tr) {
			if (!$tr instanceof ELement) continue;
			if (!$tr->isEmpty()) return false;
		}
		return true;
	}

}
<?php
namespace Sy\Component\Html\Table;
use Sy\Component\Html\Container;

/**
 * The tr element container
 */
class TrContainer extends Container {

	/**
	 * Add a tr element
	 *
	 * @param array $attributes tr element attributes
	 * @return Tr
	 */
	public function addTr($attributes = array()) {
		$element = new Tr();
		$element->setAttributes($attributes);
		return $this->addElement($element);
	}

}
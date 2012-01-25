<?php
namespace Sy\Component\Html\Table;

use Sy\Component\Html\Container,
	Sy\Component\Html\Element;

/**
 * The <tr> tag defines a row in an HTML table.
 * A tr element contains one or more th or td elements.
 */
class Tr extends Container {

	public function __construct() {
		parent::__construct('tr');
	}

	/**
	 * Add a th element
	 *
	 * @param string $data th element text
	 * @param array $attributes th element attributes
	 * @return Element
	 */
	public function addTh($data, array $attributes = array()) {
		$element = new Element('th');
		$element->setContent($data);
		$element->setAttributes($attributes);
		return $this->addElement($element);
	}

	/**
	 * Add a set of th element
	 *
	 * @param array $datas th elements text
	 * @param array $attributes th elements attributes
	 */
	public function addThs(array $datas, array $attributes = array()) {
		foreach ($datas as $data) {
			$this->addTh($data, $attributes);
		}
	}

	/**
	 * Add a td element
	 *
	 * @param string $data td element text
	 * @param array $attributes td element attributes
	 * @return Element
	 */
	public function addTd($data, array $attributes = array()) {
		$element = new Element('td');
		$element->setContent($data);
		$element->setAttributes($attributes);
		return $this->addElement($element);
	}

	/**
	 * Add a set of td element
	 *
	 * @param array $datas td elements text
	 * @param array $attributes td elements attributes
	 */
	public function addTds(array $datas, array $attributes = array()) {
		foreach ($datas as $data) {
			$this->addTd($data, $attributes);
		}
	}

	/**
	 * Return if all Td contained is empty
	 *
	 * @return bool
	 */
	public function isEmpty() {
		$tds = $this->getElements();
		foreach ($tds as $td) {
			if (!$td->isEmpty()) return false;
		}
		return true;
	}

}
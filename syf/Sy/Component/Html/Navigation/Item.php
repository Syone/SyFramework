<?php
namespace Sy\Component\Html\Navigation;

use Sy\Component\Html\Element;

class Item extends \Sy\Component\Html\Element {

	/**
	 * Item container
	 *
	 * @var Container
	 */
	private $list;

	public function __construct($title, $link) {
		parent::__construct('li');
		if (is_null($link)) {
			$this->addText($title);
		} else {
			$a = new Element('a');
			$a->setAttribute('href', $link);
			$a->addText($title);
			$this->addElement($a);
		}
		$this->list = new Element('ul');
	}

	/**
	 * Add a sub item
	 *
	 * @param string $title Item title
	 * @param string $link Item link
	 * @return Item
	 */
	public function addItem($title, $link = NULL) {
		$item = new Item($title, $link);
		return $this->list->addElement($item);
	}

	public function __toString() {
		if (!$this->list->isEmpty()) $this->addElement($this->list);
		return parent::__toString();
	}

}
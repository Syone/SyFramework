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

	public function __construct($title, $link, array $attributes = array()) {
		parent::__construct('li');
		if (is_null($link)) {
			$this->addText($title);
		} else {
			$a = new Element('a');
			$attributes['href'] = $link;
			$a->setAttributes($attributes);
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
	public function addItem($title, $link = null, array $attributes = []) {
		$item = new Item($title, $link, $attributes);
		return $this->list->addElement($item);
	}

	public function getList() {
		return $this->list;
	}

	public function __toString() {
		if (!$this->list->isEmpty()) $this->addElement($this->list);
		return parent::__toString();
	}

}
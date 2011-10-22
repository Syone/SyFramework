<?php
namespace Sy\Component\Html;

use Sy\Component\Html\Container;

class Navigation extends Container {

	public function __construct() {
		parent::__construct('ul');
	}

	/**
	 * Add an item in the navigation list
	 *
	 * @param string $title Item title
	 * @param string $link Item link
	 * @return Navigation\Item
	 */
	public function addItem($title, $link = '#') {
		$item = new Navigation\Item($title, $link);
		return $this->addElement($item);
	}

}
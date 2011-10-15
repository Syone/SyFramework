<?php
namespace Sy\Component\Html;

use Sy\Component\Html\Container;

class Navigation extends Container {

	/**
	 * Item container
	 *
	 * @var Container
	 */
	private $list;

	public function __construct() {
		parent::__construct('nav');
		$this->list = new Container('ul');
	}

	public function addItem() {
		$item = new Element('li');
		$this->list->addElement();
	}

}
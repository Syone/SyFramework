<?php
namespace Sy\Component\Html;
use Sy\Component\Html\Table\TrContainer;

/**
 * The <table> tag defines an HTML table.
 * A simple HTML table consists of the table element and one or more tr, th, and td elements.
 * The tr element defines a table row, the th element defines a table header, and the td element defines a table cell.
 * A more complex HTML table may also include caption, col, colgroup, thead, tfoot, and tbody elements.
 */
class Table extends TrContainer {

	private $caption;

	private $tHead;

	private $tBody;

	private $tFoot;

	public function __construct() {
		parent::__construct('table');
		$this->caption = new Element('caption');
		$this->tHead = new TrContainer('thead');
		$this->tBody = new TrContainer('tbody');
		$this->tFoot = new TrContainer('tfoot');
	}

	/**
	 * Return the caption element
	 *
	 * @return Element
	 */
	public function getCaption() {
		return $this->caption;
	}

	/**
	 * Return the thead element
	 *
	 * @return TrContainer
	 */
	public function getTHead() {
		return $this->tHead;
	}

	/**
	 * Return the tbody element
	 *
	 * @return TrContainer
	 */
	public function getTBody() {
		return $this->tBody;
	}

	/**
	 * Return the tfoot element
	 *
	 * @return TrContainer
	 */
	public function getTFoot() {
		return $this->tFoot;
	}

	/**
	 * Set a caption element
	 *
	 * @param string $caption caption element text
	 * @param array $attributes caption attributes
	 */
	public function setCaption($caption, array $attributes = array()) {
		$this->getCaption()->setContent($caption);
		$this->getCaption()->setAttributes($attributes);
	}

	/**
	 * Add a colgroup element
	 *
	 * @param array $attributes colgroup element attributes
	 * @return Container
	 */
	public function addColGroup(array $attributes = array()) {
		$element = new Container('colgroup');
		$element->setAttributes($attributes);
		return $this->addElement($element);
	}

	/**
	 * Add a col element
	 *
	 * @param array $attributes col element attributes
	 * @return Element
	 */
	public function addCol(array $attributes = array()) {
		$element = new Element('col');
		$element->setAttributes($attributes);
		return $this->addElement($element);
	}

	/**
	 * Return if the table is empty
	 *
	 * @return bool
	 */
	public function isEmpty() {
		return parent::isEmpty() and $this->tBody->isEmpty();
	}

	public function __toString() {
		$elements = $this->getElements();
		if (!$this->getCaption()->isEmpty()) $elements = array_unshift($elements, $this->caption);
		if (!$this->getTHead()->isEmpty()) $elements[] = $this->tHead;
		if (!$this->getTFoot()->isEmpty()) $elements[] = $this->tFoot;
		if (!$this->getTBody()->isEmpty()) $elements[] = $this->tBody;
		$this->setElements($elements);
		return parent::__toString();
	}

}
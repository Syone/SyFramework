<?php
namespace Sy\Html;

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
		$this->caption = NULL;
		$this->tHead = NULL;
		$this->tBody = NULL;
		$this->tFoot = NULL;
	}

	/**
	 * Add a caption element
	 *
	 * @param string $caption caption element text
	 * @param array $attributes caption attributes
	 * @return Element
	 */
	public function addCaption($caption, array $attributes = array()) {
		$element = new Element('caption');
		$element->setContent($caption);
		$this->caption = $element;
		return $this->caption;
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
	 * Add a thead element
	 *
	 * @param array $attributes thead element attributes
	 * @return TrContainer
	 */
	public function addTHead(array $attributes = array()) {
		$element = new TrContainer('thead');
		$element->setAttributes($attributes);
		$this->tHead = $element;
		return $this->tHead;
	}

	/**
	 * Add a tbody element
	 *
	 * @param array $attributes tbody element attributes
	 * @return TrContainer
	 */
	public function addTBody(array $attributes = array()) {
		$element = new TrContainer('tbody');
		$element->setAttributes($attributes);
		$this->tBody = $element;
		return $this->tBody;
	}

	/**
	 * Add a tfoot element
	 *
	 * @param array $attributes tfoot element attributes
	 * @return TrContainer
	 */
	public function addTFoot(array $attributes = array()) {
		$element = new TrContainer('tfoot');
		$element->setAttributes($attributes);
		$this->tFoot = $element;
		return $this->tFoot;
	}

	public function __toString() {
		$elements = $this->getElements();
		if (!is_null($this->caption)) $elements = array_unshift($elements, $this->caption);
		if (!is_null($this->tHead)) $elements[] = $this->tHead;
		if (!is_null($this->tFoot)) $elements[] = $this->tFoot;
		if (!is_null($this->tBody)) $elements[] = $this->tBody;
		$this->setElements($elements);
		return parent::__toString();
	}

}

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
	public function addTh($data, $attributes = array()) {
		$element = new Element('th');
		$element->setContent($data);
		$element->setAttributes($attributes);
		return $this->addElement($element);
	}

	/**
	 * Add a td element
	 *
	 * @param string $data td element text
	 * @param array $attributes td element attributes
	 * @return Element
	 */
	public function addTd($data, $attributes = array()) {
		$element = new Element('td');
		$element->setContent($data);
		$element->setAttributes($attributes);
		return $this->addElement($element);
	}

}
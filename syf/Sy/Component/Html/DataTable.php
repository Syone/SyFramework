<?php
namespace Sy\Component\Html;

use Sy\Db\ITable;

class DataTable extends Table {

	private $heads;

	private $autoHead;

	private $transpose;

	private $options;

	private $replaces;

	public function __construct(array $rows = array(), array $attributes = array()) {
		parent::__construct($attributes);
		$this->heads = array();
		$this->addRows($rows);
		$this->autoHead = false;
		$this->transpose = false;
	}

	/**
	 * Return if DataTable must align value
	 *
	 * @return bool
	 */
	private function hasAlign() {
		return isset($this->options['align']);
	}

	/**
	 * Return if DataTable must align header
	 *
	 * @return bool
	 */
	private function hasHeadAlign() {
		return isset($this->options['head_align']);
	}

	/**
	 * Return if DataTable must align footer
	 *
	 * @return bool
	 */
	private function hasFootAlign() {
		return isset($this->options['foot_align']);
	}

	/**
	 * Return if DataTable must align numeric value
	 *
	 * @return bool
	 */
	private function hasNumAlign() {
		return isset($this->options['num_align']);
	}

	/**
	 * Return if DataTable must format numeric value
	 *
	 * @return bool
	 */
	private function hasNumFormat() {
		return isset($this->options['num_decimals']);
	}

	/**
	 * Return if DataTable must perform a regular expression search and replace
	 *
	 * @return bool
	 */
	private function hasPregReplace() {
		return isset($this->replaces);
	}

	/**
	 * Transpose a 2D array
	 *
	 * @param array $rows
	 * @return array
	 */
	private function transpose($rows) {
		$res = array();
		foreach ($rows as $row => $cols) {
			foreach ($cols as $col => $value) {
				$res[$col][$row] = $value;
			}
		}
		return $res;
	}

	/**
	 * Set value alignment
	 *
	 * @param string $align Alignement available: 'left', 'center', 'right', 'justify', 'char'
	 */
	public function setAlign($align) {
		switch ($align) {
			case 'left':
			case 'center':
			case 'right':
			case 'justify':
			case 'char':
				$this->options['align'] = $align; break;
		}
	}

	/**
	 * Set head alignment
	 *
	 * @param string $align Alignement available: 'left', 'center', 'right', 'justify', 'char'
	 */
	public function setHeadAlign($align) {
		switch ($align) {
			case 'left':
			case 'center':
			case 'right':
			case 'justify':
			case 'char':
				$this->options['head_align'] = $align; break;
		}
	}

	/**
	 * Set foot alignment
	 *
	 * @param string $align Alignement available: 'left', 'center', 'right', 'justify', 'char'
	 */
	public function setFootAlign($align) {
		switch ($align) {
			case 'left':
			case 'center':
			case 'right':
			case 'justify':
			case 'char':
				$this->options['foot_align'] = $align; break;
		}
	}

	/**
	 * Set numeric value alignment
	 *
	 * @param string $align Alignement available: 'left', 'center', 'right', 'justify', 'char'
	 */
	public function setNumAlign($align) {
		switch ($align) {
			case 'left':
			case 'center':
			case 'right':
			case 'justify':
			case 'char':
				$this->options['num_align'] = $align; break;
		}
	}

	/**
	 * Set numeric value format
	 *
	 * @param int $decimals Sets the number of decimal points.
	 * @param string $decPoint Sets the separator for the decimal point.
	 * @param string $thousandsSep Sets the thousands separator.
	 */
	public function setNumFormat($decimals = 0, $decPoint = '.', $thousandsSep = ',') {
		$this->options['num_decimals']      = $decimals;
		$this->options['num_dec_point']     = $decPoint;
		$this->options['num_thousands_sep'] = $thousandsSep;
	}

	/**
	 * Perform a regular expression search and replace
	 *
	 * @param string $pattern
	 * @param string $replacement
	 */
	public function addPregReplace($pattern, $replacement) {
		$this->replaces[] = array('pattern' => $pattern, 'replacement' => $replacement);
	}

	/**
	 * Set if the table header must be auto generated using data keys or not
	 *
	 * @param bool $auto
	 */
	public function setAutoHead($auto) {
		$this->autoHead = $auto;
	}

	/**
	 * Set if the table must be transpose or not
	 *
	 * @param bool $tranpose
	 */
	public function setTranspose($transpose) {
		$this->transpose = $transpose;
	}

	/**
	 * Set head rows
	 *
	 * @param array $heads Array of head row
	 */
	public function setHeads(array $heads) {
		$this->getTHead()->setElements(array());
		$this->addHeads($heads);
	}

	/**
	 * Add head rows
	 *
	 * @param array $heads Array of head row
	 */
	public function addHeads(array $rows) {
		foreach ($rows as $row) {
			$this->addHead($rows);
		}
	}

	/**
	 * Add head row
	 *
	 * @param array $heads Array of head data
	 */
	public function addHead(array $datas) {
		$tr = $this->getTHead()->addTr();
		foreach ($datas as $data) {
			$tr->addTh($data);
		}
	}

	/**
	 * Set foot row
	 *
	 * @param array $foots Array of foot data
	 */
	public function setFoots(array $foots) {
		$this->getTHead()->setElements(array());
		$this->addHeads($heads);
	}

	/**
	 * Add foot rows
	 *
	 * @param array $heads Array of foot row
	 */
	public function addFoots(array $rows) {
		foreach ($rows as $row) {
			$this->addFoot($rows);
		}
	}

	/**
	 * Add foot row
	 *
	 * @param array $heads Array of foot data
	 */
	public function addFoot(array $datas) {
		$tr = $this->getTFoot()->addTr();
		foreach ($datas as $data) {
			$tr->addTd($data);
		}
	}

	/**
	 * Set table rows
	 *
	 * @param array $rows
	 */
	public function setRows(array $rows) {
		$this->getTBody()->setElements(array());
		$this->addRows($rows);
	}

	/**
	 * Add rows in the table
	 *
	 * @param array $rows 2D array
	 * @param bool $autoHead Generate head using row keys
	 * @param bool $transpose Transpose table data
	 */
	public function addRows(array $rows) {
		foreach ($rows as $row) {
			$this->addRow($row);
		}
	}

	/**
	 * Add a row in the table
	 *
	 * @param array $datas Array of data
	 */
	public function addRow(array $datas) {
		$tr = $this->getTBody()->addTr();
		foreach ($datas as $data) {
			$tr->addTd($data);
		}
		if (empty($this->heads)) $this->heads = array_keys($datas);
	}

	/**
	 * Add rows from a database table
	 *
	 * @param ITable $table
	 * @param bool $transpose
	 */
	public function addDbRows(ITable $table) {
		$this->addRows($table->getRows());
	}

	/**
	 * Align the element
	 *
	 * @param Element $element
	 * @param string $align
	 */
	private function processAlign($element, $align) {
		if ($element instanceof Table\TrContainer) {
			foreach ($element->getElements() as $e) {
				$this->processAlign($e, $align);
			}
		} else if ($element instanceof Table\Tr) {
			$element->setAttribute('align', $align);
		}
	}

	/**
	 * Format value
	 *
	 * @param Element $element
	 */
	private function processFormat($element) {
		if ($element instanceof Container) {
			foreach ($element->getElements() as $e) {
				$this->processFormat($e);
			}
		} else if ($element instanceof Element) {
			$data = $element->getContent();
			$isNumeric = is_numeric($data);
			if ($isNumeric and $this->hasNumAlign()) {
				$element->setAttribute('align', $this->options['num_align']);
			}
			if ($isNumeric and $this->hasNumFormat()) {
				$data = number_format($data, $this->options['num_decimals'], $this->options['num_dec_point'], $this->options['num_thousands_sep']);
				$element->setContent($data);
			}
			if ($this->hasPregReplace()) {
				foreach ($this->replaces as $replace) {
					$data = preg_replace($replace['pattern'], $replace['replacement'], $data);
					$element->setContent($data);
				}
			}
		}
	}

	public function __toString() {
		if ($this->hasAlign()) {
			$this->processAlign($this->getTBody(), $this->options['align']);
			$this->processAlign($this, $this->options['align']);
		}
		if ($this->getTHead()->isEmpty() and $this->autoHead) $this->addHead($this->heads);
		if ($this->hasHeadAlign()) $this->processAlign($this->getTHead(), $this->options['head_align']);
		if ($this->hasFootAlign()) $this->processAlign($this->getTFoot(), $this->options['foot_align']);
		if ($this->hasNumFormat() or $this->hasNumAlign() or $this->hasPregReplace()) {
			$this->processFormat($this->getTBody());
			$this->processFormat($this);
		}
		return parent::__toString();
	}

}
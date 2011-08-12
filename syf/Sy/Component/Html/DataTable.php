<?php
namespace Sy\Component\Html;

use Sy\Component\Html\Table;
use Sy\Db\ITable;

class DataTable extends Table {

	private $heads;

	private $foots;

	private $rows;

	private $autoHead;

	private $transpose;

	private $options;

	private $replaces;

	public function __construct(array $rows = array(), array $attributes = array()) {
		parent::__construct($attributes);
		$this->heads = array();
		$this->foots = array();
		$this->rows = $rows;
		$this->autoHead = false;
		$this->transpose = false;
	}

	/**
	 * Return if DataTable must align numeric value
	 *
	 * @return bool
	 */
	private function hasAlign() {
		return isset($this->options['align']);
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
	 * @param mixed $pattern
	 * @param miced $replacement
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
	 * Set head row
	 *
	 * @param array $heads Array of head data
	 */
	public function setHeads(array $heads) {
		$this->heads = $heads;
	}

	/**
	 * Set foot row
	 *
	 * @param array $foots Array of foot data
	 */
	public function setFoots(array $foots) {
		$this->foots = $foots;
	}

	/**
	 * Set table rows
	 *
	 * @param array $rows
	 */
	public function setRows(array $rows) {
		$this->rows = $rows;
	}

	/**
	 * Add a row in the table
	 *
	 * @param array $datas Array of data
	 */
	public function addRow(array $datas) {
		$this->rows[] = $datas;
	}

	/**
	 * Add rows in the table
	 *
	 * @param array $rows 2D array
	 * @param bool $autoHead Generate head using row keys
	 * @param bool $transpose Transpose table data
	 */
	public function addRows(array $rows) {
		$this->rows = array_merge($this->rows, $rows);
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
	 * Render table heads
	 */
	private function renderHeads() {
		$header = $this->getTHead();
		$header->setElements(array());
		$tr = $header->addTr();
		foreach ($this->heads as $head) {
			$tr->addTh($head);
		}
	}

	/**
	 * Render table foots
	 */
	private function renderFoots() {
		$footer = $this->getTFoot();
		$footer->setElements(array());
		$tr = $footer->addTr();
		foreach ($this->foots as $foot) {
			$tr->addTd($foot);
		}
	}

	/**
	 * Add a row in the table
	 *
	 * @param array $datas Array of data
	 * @param string $head Row head
	 */
	private function renderRow(array $datas, $head = '') {
		$tr = $this->getTBody()->addTr();
		if ($this->hasAlign())
			$tr->setAttribute('align', $this->options['align']);
		if (!empty($head)) $tr->addTh($head);
		foreach ($datas as $data) {
			$isNumeric = is_numeric($data);
			if ($this->hasNumFormat())
				$data = $isNumeric ? number_format($data, $this->options['num_decimals'], $this->options['num_dec_point'], $this->options['num_thousands_sep']) : $data;
			if ($this->hasPregReplace()) {
				foreach ($this->replaces as $replace)
					$data = preg_replace($replace['pattern'], $replace['replacement'], $data);
			}
			$td = $tr->addTd($data);
			if ($this->hasNumAlign() and $isNumeric)
				$td->setAttribute('align', $this->options['num_align']);
		}
	}

	/**
	 * Render table rows
	 */
	private function renderRows() {
		if ($this->transpose) {
			$this->rows = $this->transpose($this->rows);
			if ($this->autoHead) {
				$this->heads = array_keys($this->rows);
				$i = 0;
				foreach ($this->rows as $row) {
					$this->renderRow($row, $this->heads[$i++]);
				}
				return;
			}
		} else {
			if ($this->autoHead) {
				if (empty($this->heads)) {
					$this->heads = array_keys(current($this->rows));
				}
			}
			$this->renderHeads();
		}
		foreach ($this->rows as $row) {
			$this->renderRow($row);
		}
	}

	public function __toString() {
		$this->renderRows();
		$this->renderFoots();
		return parent::__toString();
	}

}
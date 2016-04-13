<?php
namespace Sy\Db;

interface ITable {

	/**
	 * Select all rows
	 *
	 * @return array An associative array of (field name => value)
	 */
	public function getRows();

}
<?php
namespace Sy;

class Db extends SyObject {

	/**
	 * Database connection (PDO)
	 *
	 * @var PDO
	 */
	private $connection;

	/**
	 * The last PDO statement prepared
	 *
	 * @var PDOStatement
	 */
	private $statement;

	public function __construct($dsn, $username = '', $passwd = '', $options = array()) {
		try {
			$this->connection = Db\Connection::instance($dsn, $username, $passwd, $options);
		} catch (PDOException $e) {
			$this->logError($e->getMessage());
		}
	}

	/**
	 * Return database connection (PDO)
	 *
	 * @return PDO
	 */
	public function getConnection() {
		return $this->connection;
	}

	/**
	 * Return the last PDO statement prepared
	 *
	 * @return PDOStatement
	 */
	public function getStatement() {
		return $this->statement;
	}

}
<?php
namespace Sy\Db;

class Connection {

	private static $connections = array();

	public static function instance($dsn, $username = '', $passwd = '', $options = array()) {
		$key = md5($dsn . $username . $passwd . serialize($options));
		if (!isset(self::$connections[$key]))
			self::$connections[$key] = new PDO($dsn, $username, $passwd, $options);
		return self::$connections[$key];
	}

}

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
			$this->connection = SyDbConnection::instance($dsn, $username, $passwd, $options);
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
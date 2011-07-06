<?php
namespace Sy;

use Sy\Db\Connection;

class Db extends Object {

	/**
	 * Database connection (PDO)
	 *
	 * @var PDO
	 */
	private $connection;

	public function __construct($dsn, $username = '', $passwd = '', $options = array()) {
		try {
			$this->connection = Connection::instance($dsn, $username, $passwd, $options);
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
	 * Prepares a statement for execution and returns a PDOStatement object.
	 * Return false on failure.
	 *
	 * @param string $sql This must be a valid SQL statement for the target database server.
	 * @param array $driverOptions This array holds one or more key=>value pairs to set attribute values for the PDOStatement object that this method returns.
	 * @return PDOStatement
	 */
	public function prepare($sql, array $driverOptions = array()) {
		if (is_null($this->getConnection())) return false;
		try {
			$statement = $this->getConnection()->prepare($sql, $driverOptions);
		} catch (PDOException $e) {
			$this->logError($e->getMessage());
			$statement = false;
		}
		return $statement;
	}

	/**
	 * Performs a non-query SQL statement, such as INSERT, UPDATE and DELETE.
	 * It returns the number of rows that are affected by the execution.
	 *
	 * @param string $sql The SQL query to execute.
	 * @param array $params The parameters to bind to the query, if any.
	 * @return int The number of rows affected by the execution.
	 */
	public function execute($sql, array $params = array()) {
		$statement = $this->prepare($sql);
		$res = $statement->execute($params);
		if ($res === false) {
			$parameters = empty($params) ? '' : 'Parameters:<pre>' . print_r($params, true)  . '</pre>';
			$this->logError('Error info:<pre>' . print_r($statement->errorInfo(), true) . '</pre>' . 'Query:<pre>' . $query . '</pre>' . $params);
			return 0;
		}
		return $statement->rowCount();
	}

	/**
	 * Performs an SQL statement that returns rows of data, such as SELECT.
	 * If successful, it returns a PDOStatement instance from which one can traverse the resulting rows of data.
	 * For convenience, a set of queryXXX() methods are also implemented which directly return the query results.
	 *
	 * @param string $sql The SQL query to execute.
	 * @param array $params The parameters to bind to the query, if any.
	 * @return PDOStatement
	 */
	public function query($sql, array $params = array()) {
		$statement = $this->prepare($sql);
		$res = $statement->execute($params);
		if ($res === false) {
			$parameters = empty($params) ? '' : 'Parameters:<pre>' . print_r($params, true)  . '</pre>';
			$this->logError('Error info:<pre>' . print_r($statement->errorInfo(), true) . '</pre>' . 'Query:<pre>' . $query . '</pre>' . $params);
		}
		return $res;
	}

	/**
	 * Executes the SQL statement and returns all rows.
	 *
	 * @param string $sql The SQL query to execute.
	 * @param array $params The parameters to bind to the query, if any.
	 * @return array
	 */
	public function queryAll($sql, array $params = array()) {
		$statement = $this->query($sql, $params);
		if ($statement === false) return array();
		//TODO fetchAll parameters
		return $statement->fetchAll();
	}

}
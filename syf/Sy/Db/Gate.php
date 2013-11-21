<?php
namespace Sy\Db;

class Gate extends \Sy\Object {

	private $dsn;
	private $username;
	private $password;
	private $driverOptions;

	/**
	 * @var \PDO
	 */
	private $pdo;

	/**
	 * Gate constructor.
	 *
	 * @param string $dsn
	 * @param string $username
	 * @param string $password
	 * @param array $driverOptions
	 */
	public function __construct($dsn, $username = '', $password = '', array $driverOptions = array()) {
		$this->dsn           = $dsn;
		$this->username      = $username;
		$this->password      = $password;
		$this->driverOptions = $driverOptions;
	}

	/**
	 * Returns debug backtrace informations
	 *
	 * @return array
	 */
	public function getDebugTrace() {
		$trace = debug_backtrace();
		$i = 1;
		while (isset($trace[$i]) and isset($trace[$i + 1]) and isset($trace[$i + 1]['class']) and ($trace[$i + 1]['class'] === 'Sy\Db\Gate')) $i++;
		$res['class']    = isset($trace[$i + 1]['class'])    ? $trace[$i + 1]['class']    : '';
		$res['function'] = isset($trace[$i + 1]['function']) ? $trace[$i + 1]['function'] : '';
		$res['file']     = $trace[$i]['file'];
		$res['line']     = $trace[$i]['line'];
		return $res;
	}


	/**
	 * Returns the \PDO object.
	 *
	 * @return \PDO
	 * @throws PDOException
	 */
	public function getPdo() {
		if (!isset($this->pdo)) {
			try {
				$this->pdo = PDOManager::getPDOInstance($this->dsn, $this->username, $this->password, $this->driverOptions);
				$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			} catch (\PDOException $e) {
				$this->logError($e->getMessage());
				throw new PDOException($e->getMessage(), $e->getCode());
			}
		}
		return $this->pdo;
	}

	/**
	 * Set the \PDO object.
	 *
	 * @param \PDO $pdo
	 */
	public function setPdo(\PDO $pdo) {
		$this->pdo = $pdo;
	}

	/**
	 * Initiates a transaction.
	 *
	 * @return bool
	 * @throws TransactionException
	 */
	public function beginTransaction() {
		try {
			return $this->getPdo()->beginTransaction();
		} catch (\PDOException $e) {
			$this->logError($e->getMessage());
			throw new TransactionException($e->getMessage(), $e->getCode());
		}
	}

	/**
	 * Commits a transaction.
	 *
	 * @return bool
	 * @throws TransactionException
	 */
	public function commit() {
		try {
			return $this->getPdo()->commit();
		} catch (\PDOException $e) {
			$this->logError($e->getMessage());
			throw new TransactionException($e->getMessage(), $e->getCode());
		}
	}

	/**
	 * Rolls back a transaction.
	 *
	 * @return bool
	 * @throws TransactionException
	 */
	public function rollBack() {
		try {
			return $this->getPdo()->rollBack();
		} catch (\PDOException $e) {
			$this->logError($e->getMessage());
			throw new TransactionException($e->getMessage(), $e->getCode());
		}
	}

	/**
	 * Prepares a statement for execution and returns a PDOStatement object.
	 *
	 * @param string $sql This must be a valid SQL statement for the target database server.
	 * @param array $driverOptions This array holds one or more key=>value pairs to set attribute values for the PDOStatement object that this method returns.
	 * @return PDOStatement
	 * @throws PrepareException
	 */
	public function prepare($sql, array $driverOptions = array()) {
		try {
			return $this->getPdo()->prepare($sql, $driverOptions);
		} catch (\PDOException $e) {
			$this->logError($e->getMessage());
			throw new PrepareException($e->getMessage(), $e->getCode());
		}
	}

	/**
	 * Performs a non-query SQL statement, such as INSERT, UPDATE and DELETE.
	 * It returns the number of rows that are affected by the execution.
	 *
	 * @param string | Sy\Db\Sql $sql The SQL query to execute.
	 * @return int The number of rows affected by the execution.
	 * @throws ExecuteException
	 */
	public function execute($sql) {
		$query = $sql;
		$params = array();
		if ($sql instanceof Sql) {
			$params = $sql->getParams();
			$query = $sql->getSql();
		}
		try {
			$info = $this->getDebugTrace();
			$info['type'] = 'QueryLog';
			$this->logQuery($sql, $info);
			$statement = $this->prepare($query);
			$statement->execute($params);
			return $statement->rowCount();
		} catch (\PDOException $e) {
			$info = $this->getDebugTrace();
			$info['message'] = $e->getMessage();
			$info['level'] = \Sy\Debug\Log::ERR;
			$this->logQuery($sql, $info);
			if ($e->getCode() === '23000') {
				throw new IntegrityConstraintViolationException($e->getMessage(), $e->getCode());
			} else {
				throw new ExecuteException($e->getMessage(), $e->getCode());
			}
		}
	}

	/**
	 * Performs an SQL statement that returns rows of data, such as SELECT.
	 * If successful, it returns a PDOStatement instance from which one can traverse the resulting rows of data.
	 * For convenience, a set of queryXXX() methods are also implemented which directly return the query results.
	 *
	 * @param string | Sy\Db\Sql $sql The SQL query to execute.
	 * @return PDOStatement
	 * @throws QueryException
	 */
	public function query($sql) {
		$query = $sql;
		$params = array();
		if ($sql instanceof Sql) {
			$params = $sql->getParams();
			$query = $sql->getSql();
		}
		try {
			$info = $this->getDebugTrace();
			$info['type'] = 'QueryLog';
			$this->logQuery($sql, $info);
			$statement = $this->prepare($query);
			$statement->execute($params);
		} catch(\PDOException $e) {
			$info = $this->getDebugTrace();
			$info['message'] = $e->getMessage();
			$info['level'] = \Sy\Debug\Log::ERR;
			$this->logQuery($sql, $info);
			throw new QueryException($e->getMessage(), $e->getCode());
		}
		return $statement;
	}

	/**
	 * Executes the SQL statement and returns all rows.
	 * See PDOStatement::fetchAll() method documentation for optionnal parameters.
	 *
	 * @param string | Sy\Db\Sql $sql The SQL query to execute.
	 * @param int $fetchStyle Controls the contents of the returned array as documented in PDOStatement::fetch().
	 * @param mixed $fetchArgs This argument have a different meaning depending on the value of the fetchStyle parameter
	 * @param array $ctorArgs Arguments of custom class constructor when the fetchStyle parameter is \PDO::FETCH_CLASS
	 * @return array
	 * @throws QueryAllException
	 */
	public function queryAll($sql, $fetchStyle = \PDO::FETCH_BOTH, $fetchArgs = null, $ctorArgs = array()) {
		try {
			$statement = $this->query($sql);
			if (is_null($fetchArgs))
				return $statement->fetchAll($fetchStyle);
			elseif (empty($ctorArgs))
				return $statement->fetchAll($fetchStyle, $fetchArgs);
			else
				return $statement->fetchAll($fetchStyle, $fetchArgs, $ctorArgs);
		} catch(\PDOException $e) {
			$this->logError($e->getMessage());
			throw new QueryAllException($e->getMessage(), $e->getCode());
		}
	}

	/**
	 * Executes the SQL statement and returns the value of a column in the first row of the result.
	 * This is a convenient method of query when only a single value is needed (e.g. obtaining the count of the records).
	 * See PDOStatement::fetchColumn() method documentation for optionnal parameter
	 *
	 * @param string | Sy\Db\Sql $sql
	 * @param int $columnNumber
	 * @return string
	 * @throws QueryColumnException
	 */
	public function queryColumn($sql, $columnNumber = 0) {
		try {
			$statement = $this->query($sql);
			return $statement->fetchColumn($columnNumber);
		} catch(\PDOException $e) {
			$this->logError($e->getMessage());
			throw new QueryColumnException($e->getMessage(), $e->getCode());
		}
	}

	/**
	 * Executes the SQL statement and returns the first row of the result as an object.
	 * See PDOStatement::fetchObject() method documentation for optionnal parameters.
	 *
	 * @param string | Sy\Db\Sql $sql
	 * @param string $className Name of the created class.
	 * @param array $ctorArgs Elements of this array are passed to the constructor.
	 * @return mixed
	 * @throws QueryObjectException
	 */
	public function queryObject($sql, $className = 'stdClass', array $ctorArgs = array()) {
		try {
			$statement = $this->query($sql);
			return $statement->fetchObject($className, $ctorArgs);
		} catch(\PDOException $e) {
			$this->logError($e->getMessage());
			throw new QueryObjectException($e->getMessage(), $e->getCode());
		}
	}

	/**
	 * Executes the SQL statement and returns the first row of the result.
	 * This is a convenient method of query when only the first row of data is needed.
	 * See PDOStatement::fetch() method documentation for optionnal parameters.
	 *
	 * @param string | Sy\Db\Sql $sql The SQL query to execute.
	 * @param type $fetchStyle Controls how the row will be returned to the caller. This value must be one of the \PDO::FETCH_* constants, defaulting to \PDO::FETCH_BOTH.
	 * @param type $cursorOrientation This value must be one of the \PDO::FETCH_ORI_* constants, defaulting to \PDO::FETCH_ORI_NEXT.
	 * @param type $cursorOffset Depends on cursorOrientation value
	 * @return mixed
	 * @throws QueryOneException
	 */
	public function queryOne($sql, $fetchStyle = \PDO::FETCH_BOTH, $cursorOrientation = \PDO::FETCH_ORI_NEXT, $cursorOffset = 0) {
		try {
			$statement = $this->query($sql);
			return $statement->fetch($fetchStyle, $cursorOrientation, $cursorOffset);
		} catch(\PDOException $e) {
			$this->logError($e->getMessage());
			throw new QueryOneException($e->getMessage(), $e->getCode());
		}
	}

	/**
	 * Insert a table row with specified data.
	 *
	 * @param string $table The table name.
	 * @param array $bind Column-value pairs.
	 * @return int The number of affected rows.
	 */
	public function insert($table, array $bind) {
		$bind = array_filter($bind);
		$columns = array_keys($bind);
		$columns = '`' . implode('`,`', $columns) . '`';
		$values = array_values($bind);
		$v = array_fill(0, count($bind), '?');
		$v = implode(',', $v);
		$sql = new Sql("INSERT INTO $table ($columns) VALUES ($v)", $values);
		return $this->execute($sql);
	}

}

class Exception extends \Exception {}

class PDOException extends Exception {}

class TransactionException extends Exception {}

class PrepareException extends Exception {}

class ExecuteException extends Exception {}

class QueryException extends Exception {}

class QueryAllException extends Exception {}

class QueryColumnException extends Exception {}

class QueryObjectException extends Exception {}

class QueryOneException extends Exception {}

class IntegrityConstraintViolationException extends Exception {}
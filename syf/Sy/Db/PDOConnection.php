<?php
namespace Sy\Db;

class PDOConnection extends \Sy\Object implements IConnection {
	private $dsn;
	private $username;
	private $password;
	private $driverOptions;
	private $pdo;

	/**
	 * Constructor.
	 */
	public function __construct($dsn, $username = '', $password = '', array $driverOptions = array()) {
		$this->dsn = $dsn;
		$this->username = $username;
		$this->password = $password;
		$this->driverOptions = $driverOptions;
		$this->pdo = NULL;
	}

	public function beginTransaction() {
		return $this->pdo()->beginTransaction();
	}

	public function commit() {
		return $this->pdo()->commit();
	}

	public function rollBack() {
		return $this->pdo()->rollBack();
	}

	public function execute($sql) {
		$query = $sql;
		$params = array();
		if ($sql instanceof Sql) {
			$params = $sql->getParams();
			$query = $sql->getSql();
		}
		$statement = $this->prepare($query);
		if (!$statement) return 0;
		$res = $statement->execute($params);
		if ($res === false) {
			$info = $this->getDebugTrace();
			$info['message'] = "Error info:\n" . print_r($statement->errorInfo(), true);
			$info['level'] = \Sy\Debug\Log::ERR;
			$this->logQuery($sql, $info);
			return 0;
		}
		return $statement->rowCount();
	}

	/**
	 * Return debug backtrace informations
	 *
	 * @return array
	 */
	public function getDebugTrace() {
		$trace = debug_backtrace();
		$i = 1;
		while (isset($trace[$i]) and isset($trace[$i + 1]) and isset($trace[$i + 1]['class']) and ($trace[$i + 1]['class'] === 'Sy\Db')) $i++;
		$res['class']    = $trace[$i + 1]['class'];
		$res['function'] = $trace[$i + 1]['function'];
		$res['file']     = $trace[$i]['file'];
		$res['line']     = $trace[$i]['line'];
		return $res;
	}

	public function insert($table, array $bind) {
		$columns = array_keys($bind);
		$columns = '`' . implode('`,`', $columns) . '`';
		$values = array_values($bind);
		$v = array_fill(0, count($bind), '?');
		$v = implode(',', $v);
		$sql = new Sql("INSERT INTO $table ($columns) VALUES ($v)", $values);
		return $this->execute($sql);
	}

	/**
	 * Return a reference to the \PDO object.
	 *
	 * @return \PDO
	 */
	public function pdo() {
		if ($this->pdo === NULL) {
			try {
				$this->pdo = new \PDO($this->dsn,
									  $this->username,
									  $this->password,
									  $this->driverOptions);
			} catch (\PDOException $except) {
				$this->pdo = NULL;
				throw $except;
			}
		}

		return $this->pdo;
	}

	public function prepare($sql, array $driverOptions = array()) {
		try {
			$statement = $this->pdo()->prepare($sql, $driverOptions);
		} catch (\PDOException $e) {
			$this->logError($e->getMessage());
			$statement = false;
		}
		return $statement;
	}

	public function query($sql) {
		$query = $sql;
		$params = array();
		if ($sql instanceof Sql) {
			$params = $sql->getParams();
			$query = $sql->getSql();
		}
		$statement = $this->prepare($query);
		if (!$statement) return false;
		$res = $statement->execute($params);
		if ($res === false) {
			$info = $this->getDebugTrace();
			$info['message'] = "Error info:\n" . print_r($statement->errorInfo(), true);
			$info['level'] = \Sy\Debug\Log::ERR;
			$this->logQuery($sql, $info);
			return false;
		}
		return $statement;
	}

	public function queryAll($sql, $fetchStyle = \PDO::FETCH_BOTH, $fetchArgs = NULL, $ctorArgs = array()) {
		$statement = $this->query($sql);
		if ($statement === false) return array();
		if (is_null($fetchArgs))
			return $statement->fetchAll($fetchStyle);
		else
			return $statement->fetchAll($fetchStyle, $fetchArgs, $ctorArgs);
	}

	public function queryColumn($sql, $columnNumber = 0) {
		$statement = $this->query($sql);
		if ($statement === false) return false;
		return $statement->fetchColumn($columnNumber);
	}

	public function queryObject($sql, $className = 'stdClass', array $ctorArgs = array()) {
		$statement = $this->query($sql);
		if ($statement === false) return false;
		return $statement->fetchObject($className, $ctorArgs);
	}

	public function queryOne($sql, $fetchStyle = \PDO::FETCH_BOTH, $cursorOrientation = \PDO::FETCH_ORI_NEXT, $cursorOffset = 0) {
		$statement = $this->query($sql);
		if ($statement === false) return false;
		return $statement->fetch($fetchStyle, $cursorOrientation, $cursorOffset);
	}

}

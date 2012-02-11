<?php
namespace Sy\Db;

class DelegateConnection extends \Sy\Object implements IConnection {
	private $connection;

	/**
	 * Constructor.
	 */
	public function _construct($connectionId) {
		$this->connection = ConnectionPool::get($connectionId);
	}

	public function execute($sql) {
		return $this->connection->execute($sql);
	}

    /**
     * Return debug backtrace informations.
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
		return $this->connection->insert($table, $bind);
	}

	public function prepare($sql, array $driverOptions = array()) {
		return $this->connection->prepare($sql, $driverOptions);
	}

	public function query($sql) {
		return $this->connection->query($sql);
	}

	public function queryAll($sql, $fetchStyle = \PDO::FETCH_BOTH, $fetchArgs = NULL, $ctorArgs = array()) {
		return $this->connection->queryAll($sql, $fetchStyle, $fetchArgs, $ctorArgs);
	}

	public function queryColumn($sql, $columnNumber = 0) {
		return $this->connection->queryColumn($sql, $columnNumber);
	}

	public function queryObject($sql, $className = 'stdClass', array $ctorArgs = array()) {
		return $this->connection->queryObject($sql, $className, $ctorArgs);
	}

	public function queryOne($sql, $fetchStyle = \PDO::FETCH_BOTH, $cursorOrientation = \PDO::FETCH_ORI_NEXT, $cursorOffset = 0) {
		return $this->connection->queryOne($sql, $fetchStyle, $cursorOrientation, $cursorOffset);
	}

}

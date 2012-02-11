<?php
namespace Sy\Db;

class ConnectionPool {
	private static $instance;
	private $connections = array();

	/**
	 * Add a new connection to the connection pool.
	 *
	 * @param string $connectionId
	 * @param Sy\Db\Connection
	 * @return bool
	 */
	private function addConnection($connectionId, $connection) {
		if (isset($this->connections[$connectionId]))
		  return false;

		$this->connections[$connectionId] = $connection;

		return true;
	}

	/**
	 * Get the unique instance of the Connection Pool.
	 *
	 * @return Sy\Db\ConnectionPool
	 */
	public static function instance() {
		if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}

		return self::$instance;
	}

	/**
	 * Get a database connection.
	 *
	 * @param string $connectionId
	 * @return Sy\Db\Connection | NULL
	 */
	public static function get($connectionId) {
		return ConnectionPool::instance()->getConnection($connectionId);
	}

	/**
	 * Get a database connection from the pool.
	 *
	 * @param string $connectionId
	 * @return Sy\Db\Connection | NULL
	 */
	private function getConnection($connectionId) {
		if ($connectionId === NULL || !isset($this->connections[$connectionId]))
		  return NULL;

		return $this->connections[$connectionId];
	}

	/**
	 * Register a new database connection. The connection will be opened only when required.
	 *
	 * @param string $connectionId
	 * @param string $username
	 * @param string $password
	 * @param array $driver_options
	 */
	public static function register($connectionId, $dsn, $username = '', $password = '', array $driver_options = array()) {
		$connection = new Connection($dsn, $username, $password);

		ConnectionPool::instance()->addConnection($connectionId, $connection);
	}

}

<?php
namespace Sy\Db;

interface IConnection {

	/**
	 * Initiates a transaction.
	 */
	public function beginTransaction();

	/**
	 * Commits a transaction.
	 */
	public function commit();

	/**
	 * Rolls back a transaction.
	 */
	public function rollBack();

    /**
     * Performs a non-query SQL statement, such as INSERT, UPDATE and DELETE.
     * It returns the number of rows that are affected by the execution.
     *
     * @param string | Sy\Db\Sql $sql The SQL query to execute.
     * @return int The number of rows affected by the execution.
     */
    public function execute($sql);

	/**
	 * Insert a table row with specified data.
	 *
	 * @param string $table The table name.
	 * @param array $bind Column-value pairs.
	 * @return int The number of affected rows.
	 */
	public function insert($table, array $bind);

    /**
     * Prepares a statement for execution and returns a PDOStatement object.
     * Return false on failure.
     *
     * @param string $sql This must be a valid SQL statement for the target database server.
     * @param array $driverOptions This array holds one or more key=>value pairs to set attribute values for the PDOStatement object that this method returns.
     * @return PDOStatement
     */
    public function prepare($sql, array $driverOptions);

	/**
	 * Performs an SQL statement that returns rows of data, such as SELECT.
	 * If successful, it returns a PDOStatement instance from which one can traverse the resulting rows of data.
	 * For convenience, a set of queryXXX() methods are also implemented which directly return the query results.
	 *
	 * @param string | Sy\Db\Sql $sql The SQL query to execute.
	 * @return PDOStatement
	 */
	public function query($sql);

	/**
	 * Executes the SQL statement and returns all rows.
	 * See PDOStatement::fetchAll() method documentation for optionnal parameters.
	 *
	 * @param string | Sy\Db\Sql $sql The SQL query to execute.
	 * @param int $fetchStyle Controls the contents of the returned array as documented in PDOStatement::fetch().
	 * @param mixed $fetchArgs This argument have a different meaning depending on the value of the fetchStyle parameter
	 * @param array $ctorArgs Arguments of custom class constructor when the fetchStyle parameter is \PDO::FETCH_CLASS
	 * @return array
	 */
	public function queryAll($sql, $fetchStyle, $fetchArgs, $ctorArgs);

	/**
	 * Executes the SQL statement and returns the value of a column in the first row of the result.
	 * This is a convenient method of query when only a single value is needed (e.g. obtaining the count of the records).
	 * See PDOStatement::fetchColumn() method documentation for optionnal parameter
	 *
	 * @param string | Sy\Db\Sql $sql
	 * @param int $columnNumber
	 * @return string
	 */
	public function queryColumn($sql, $columnNumber);

	/**
	 * Executes the SQL statement and returns the first row of the result as an object.
	 * See PDOStatement::fetchObject() method documentation for optionnal parameters.
	 *
	 * @param string | Sy\Db\Sql $sql
	 * @param string $className Name of the created class.
	 * @param array $ctorArgs Elements of this array are passed to the constructor.
	 * @return mixed
	 */
	public function queryObject($sql, $className, array $ctorArgs);

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
	 */
	public function queryOne($sql, $fetchStyle, $cursorOrientation, $cursorOffset);

}

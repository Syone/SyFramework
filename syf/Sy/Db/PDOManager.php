<?php
namespace Sy\Db;

class PDOManager {

	private static $connections = array();

    public static function getPDOInstance($dsn, $username = '', $passwd = '', array $options = array()) {
        $key = md5($dsn . $username . $passwd . serialize($options));
        if (!isset(self::$connections[$key]))
            self::$connections[$key] = new \PDO($dsn, $username, $passwd, $options);
        return self::$connections[$key];
    }

}
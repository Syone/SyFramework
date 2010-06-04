<?php
namespace Sy;

class ConnectionManager {
  private static $instance;
  private $connectionPool;
  private $driverPrefix;
  private $hostPrefix;
  private $databasePrefix;
  private $usernamePrefix;
  private $passwordPrefix;

  public static function instance() {
    if (!isset(self::$instance))
      self::$instance = new __CLASS__;

    return self::$instance;
  }

  private function __construct() {
    $this->connectionPool = array();
    $this->driverPrefix = 'DRIVER';
    $this->hostPrefix = 'HOST';
    $this->databasePrefix = 'DATABASE';
    $this->usernamePrefix = 'USERNAME';
    $this->passwordPrefix = 'PASSWORD';
  }

  public function getConnection($databaseID) {
    $DBID = isset($databaseID) ? $databaseID : 0;
    if (isset($this->connectionPool[$DBID]))
      return $this->connectionPool[$DBID];

    if (defined($this->driverPrefix.$DBID))
      $connectionSuffix = $DBID;
    elseif (defined($this->driverPrefix))
      $connectionSuffix = '';
    else {
      // ERROR: unknown $databaseID.
      return null;
    }

    $database = new Database($this->driverPrefix.$connectionSuffix,
                             $this->hostPrefix.$connectionSuffix,
                             $this->databasePrefix.$connectionSuffix,
                             $this->usernamePrefix.$connectionSuffix,
                             $this->passwordPrefix.$connectionSuffix);

    if (!$database->open()) {
      // ERROR: not able to connect to database.
      return null;
    }

    $this->connectionPool[$DBID] = $database;

    return $database;
  }
}

?>

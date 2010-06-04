<?php
namespace Sy;

class Query {
  private $DBConnection;
  private $PDOStatement;

  public function __construct($databaseID) {
    $this->DBConnection = ConnectionManager::getConnection($databaseID);

    // FIXME maybe check whether connection is retrieved.

    $this->affectedRows = 0;
  }

  public function errorInfo() {
    $infos = $this->PDOStatement->errorInfo();

    if (!isset($infos[0]))
      return null;


    return $infos[2];
  }

  public function execute($query, $params) {
    $ret = true;

    try {
      $this->PDOStatement = $this->DBConnection->prepare($query);
      $this->PDOStatement->execute($params);
    } catch (PDOException $e) {
      $ret = false;
    }

    return $ret;
  }

  public function fetch() {
    return $this->PDOStatement->fetch();
  }

  public function getStatement() {
    return $this->PDOStatement;
  }

  public function rowCount() {
    return $this->PDOStatement->rowCount();
  }
}

?>

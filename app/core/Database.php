<?php

class Database extends PDO
{
  private $db_host = DB_HOST;
  private $db_user = DB_USER;
  private $db_pass = DB_PASS;
  private $db_name = DB_NAME;

  private $database_handler;
  private $statement;

  // Konfigurasi database
  private $optionPDO = [
    PDO::ATTR_PERSISTENT => true, // Optimasi
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Mode Error tampilkan exception
  ];

  public function __construct()
  {
    $data_source_name = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name;
    parent::__construct($data_source_name, $this->db_user, $this->db_pass, $this->optionPDO);
  }

  protected function sql($sql)
  {
    $this->statement = $this->prepare($sql);
  }

  // Binding data, siapa tau di dalam querynya ada WHERE, INSERT INTO ... VALUES ... dll
  protected function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
          break;
      }
    }

    $this->statement->bindValue($param, $value, $type);
  }

  protected function execute()
  {
    $this->statement->execute();
  }

  protected function rowCount()
  {
    return $this->statement->rowCount();
  }

  protected function getAll()
  {
    $this->execute();
    return $this->statement->fetchAll(PDO::FETCH_ASSOC);
  }

  protected function getOne()
  {
    $this->execute();
    return $this->statement->fetch(PDO::FETCH_ASSOC);
  }
}

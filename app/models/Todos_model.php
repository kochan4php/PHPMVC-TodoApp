<?php

class Todos_Model extends Database
{
  public function getAllTodos()
  {
    $this->sql('SELECT * FROM todos ORDER BY status ASC');
    return $this->getAll();
  }

  public function getTodosById($id)
  {
    $this->sql('SELECT * FROM todos WHERE id = :id');
    $this->bind('id', $id);
    $this->execute();

    return $this->getOne();
  }

  public function addNewTodos($kegiatan)
  {
    $query = "INSERT INTO todos VALUES('', :kegiatan, 0)";
    $this->sql($query);
    $this->bind('kegiatan', $kegiatan['kegiatan']);
    $this->execute();

    return $this->rowCount();
  }

  public function updateStatusTodos($id)
  {
    $todo = $this->getTodosById($id);
    $status = $todo['status'] === 1 ? 0 : 1;
    $query = 'UPDATE todos SET status = :status WHERE id = :id';
    $this->sql($query);
    $this->bind('id', $id);
    $this->bind('status', $status);
    $this->execute();

    return $this->rowCount();
  }

  public function getAllCompletedTodos()
  {
    $query = 'SELECT * FROM todos WHERE status = 1';
    $this->sql($query);
    $this->execute();

    return $this->getAll();
  }

  public function getAllUncompletedTodos()
  {
    $query = 'SELECT * FROM todos WHERE status = 0';
    $this->sql($query);
    $this->execute();

    return $this->getAll();
  }

  public function removeTodos($id)
  {
    $query = 'DELETE FROM todos WHERE id = :id';
    $this->sql($query);
    $this->bind('id', $id);
    $this->execute();

    return $this->rowCount();
  }
}

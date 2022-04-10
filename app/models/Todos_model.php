<?php

class Todos_Model extends Database
{
  private $todos_statuses = [];

  public function getAllTodos()
  {
    $this->sql('SELECT * FROM todos');
    return $this->getAll();
  }

  public function getAllTodosByStatus()
  {
    $this->sql('SELECT * FROM todos WHERE status = 0');
    return $this->getAll();
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
    // $query = 
    $todos = $this->getAllTodosByStatus();
    foreach ($todos as $todo) {
      if ($todo['status'] === 0) {
        $query = 'UPDATE todos SET status=1 WHERE id=:id';
        $this->sql($query);
        $this->bind('id', $id);
        $this->execute();

        return $this->rowCount();
      } else if ($todo['status'] === 1) {
        $query = 'UPDATE todos SET status=0 WHERE id=:id';
        $this->sql($query);
        $this->bind('id', $id);
        $this->execute();

        return $this->rowCount();
      }
    }
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

<?php

class Todos extends Controller
{
  private $model = 'Todos_model';

  public function index()
  {
    $data['judul'] = 'Home Page';
    $data['todos'] = $this->model($this->model)->getAllTodos();

    $this->view('todos/index', $data);
  }

  public function create()
  {
    // var_dump($_POST);
    if ($this->model($this->model)->addNewTodos($_POST) > 0) {
      header('Location: ' . BASEURL);
      exit;
    }
  }

  public function updatestatus($id)
  {
    if ($this->model($this->model)->updateStatusTodos($id) > 0) {
      header('Location: ' . BASEURL);
      exit;
    }
  }

  public function destroy($id)
  {
    if ($this->model($this->model)->removeTodos($id) > 0) {
      header('Location: ' . BASEURL);
      exit;
    }
  }
}

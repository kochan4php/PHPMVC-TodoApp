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

  public function completed()
  {
    $data['judul'] = 'Completed Todos';
    $data['todos'] = $this->model($this->model)->getAllCompletedTodos();

    $this->view('todos/completed', $data);
  }

  public function uncompleted()
  {
    $data['judul'] = 'Uncompleted Todos';
    $data['todos'] = $this->model($this->model)->getAllUncompletedTodos();

    $this->view('todos/uncompleted', $data);
  }

  public function create()
  {
    if (!$_POST['kegiatan']) {
      header('Location: ' . BASEURL);
      Flasher::setFlash('gagal', 'ditambahkan', 'danger');
      die;
    } else if ($this->model($this->model)->addNewTodos($_POST) > 0) {
      header('Location: ' . BASEURL);
      Flasher::setFlash('berhasil', 'ditambahkan', 'success');
      exit;
    }
  }

  public function updatestatus($id)
  {
    if ($this->model($this->model)->updateStatusTodos($id) > 0) {
      header('Location: ' . BASEURL);
      Flasher::setFlash('berhasil', 'diselesaikan', 'success');
      exit;
    }
  }

  public function destroy($id)
  {
    if ($this->model($this->model)->removeTodos($id) > 0) {
      header('Location: ' . BASEURL);
      Flasher::setFlash('berhasil', 'dihapus', 'success');
      exit;
    } else {
      header('Location: ' . BASEURL);
      Flasher::setFlash('gagal', 'dihapus', 'danger');
      exit;
    }
  }
}

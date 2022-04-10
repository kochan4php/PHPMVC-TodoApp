<?php

class Controller
{
  public function view($view, $data = [])
  {
    require('../app/views/layouts/header.php');
    require('../app/views/' . $view . '.php');
    require('../app/views/layouts/footer.php');
  }

  public function model($model)
  {
    require('../app/models/' . $model . '.php');
    return new $model;
  }
}

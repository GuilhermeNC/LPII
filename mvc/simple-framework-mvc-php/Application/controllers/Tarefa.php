<?php

use Application\core\Controller;

class Tarefa extends Controller
{
  /**
  * chama a view index.php da seguinte forma /user/index   ou somente   /user
  * e retorna para a view todos os usuários no banco de dados.
  */
  public function index()
  {
    $Tarefas = $this->model('Tarefas'); 
    $data = $Tarefas::findAll();
    $this->view('tarefas/index', ['tarefas' => $data]);
  }

  /**
  * chama a view show.php da seguinte forma /user/show passando um parâmetro 
  * via URL /user/show/id e é retornado um array contendo (ou não) um determinado
  * usuário. Além disso é verificado se foi passado ou não um id pela url, caso
  * não seja informado, é chamado a view de página não encontrada.
  * @param  int   $id   Identificado do usuário.
  */
  public function show($id = null)
  {
    if (is_numeric($id)) {
      $Tarefas = $this->model('Tarefas');
      $data = $Tarefas::findById($id);
      $this->view('tarefas/show', ['tarefas' => $data]);
    } else {
      $this->pageNotFound();
    }
  }

  public function formulario() {
    $this->view('tarefas/add');
  }


  public function add()
  {
    $Tarefas = $this->model('Tarefas'); 
    $Tarefas::add($_POST['desc']);

    $data = $Tarefas::findAll();
    $this->view('tarefas/index', ['tarefas' => $data]);
  }
}


<?php

require("model/ChildDbModel.php");

class LogInController extends Controller
{
  private $password;

  public function __construct($login, $password)
  {
    parent::__construct($login);
    $this->model = new ChildDbModel;
    $this->login = $login;
    $this->setPassword($password);
  }

  public function launch()
  {
    if($this->model->checkLogin($this->login, $this->getPassword()) == true)
    { // Check the login in the databases
      $_SESSION['login'] = $this->login; // Initialize login on the session
      $this->view->setValue('HomePage');
    }
    else
    {
      $this->view->setValue('LogInPage');
    }
    $this->view->launch($this->model->getError(), $this->model->getValError());
    $this->view->foot();
  }

  public function getPassword(){
    return $this->password;
  }

  public function setPassword($password){
    $this->password=$password;
  }

}

?>

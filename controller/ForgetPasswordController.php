<?php

require("model/ChildDbModel.php");

class ForgetPasswordController extends Controller
{
  public $secretAnswer;
  public $reset; //1 if we want to reset it
  public $newPassword;
  public $newPassword2;
  public $change ; // 1If the change of password as been made
  
  public function __construct($login, $secretAnswer, $reset, $newPassword, $newPassword2)
  {
    parent::__construct($login);
    $this->model = new ChildDbModel();
    $this->login = $login;
    $this->secretAnswer = $secretAnswer;
    $this->reset = $reset;
    $this->newPassword2 = $newPassword2;
    $this->newPassword = $newPassword;
  }

  public function launch()
  {
    $this->view->setValue('ForgetPassword');
    $question = $this->model->whatWasTheSecretQuestion($this->login);

    if($this->reset != 1){
      if($this->model->verifySecreteAnswer($this->login, $this->secretAnswer) == true){

        $this->view->error($this->model->getError(), $this->model->getValError());
        $this->view->resetPassword($this->login);
        $this->view->foot();
      }
      elseif( $this->reset != 3){
        $this->view->error($this->model->getError(), $this->model->getValError());
        $this->view->launchForgetPassword($question, $this->login);
        $this->view->foot();
      }
      else{
        if($this->change != 1 && $this->reset != 1){
          $this->view->launchForgetPassword($question, $this->login);
          $this->view->foot();
        }
      }

    }
    else{
      if($this->model->resetPassword($this->login, $this->newPassword, $this->newPassword2) ==true){
        $this->model->setError("Ton mot de passe a bien été réinitialisé!");
        $this->model->setValError(1);
        $this->view->setValue('HomePage');
        $this->view->launch($this->model->getError(), $this->model->getValError());
        $this->view->foot();
        $this->change = 1;

      }
    }



  }
}
?>

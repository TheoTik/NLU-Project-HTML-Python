
<?php
include("model/ChildDbModel.php");

class SignInController extends Controller
{
  public $password;
  public $passwordBis;
  public $firstName;
  public $lastName;
  public $email;
  public $emailParent;
  public $controlValue;
  public $choiceNumber;
  public $secretAnswer;

  public function __construct($login, $email, $password, $passwordBis, $firstName, $lastName, $emailParent, $controlValue, $choiceNumber, $secretAnswer)
  {
    parent::__construct($login);
    $this->model = new ChildDbModel;
    $this->password = $password;
    $this->passwordBis = $passwordBis;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->emailParent = $emailParent;
    $this->email = $email;
    $this->controlValue = $controlValue;
    $this->ChoiceValue = $choiceNumber;
    $this->secretAnswer = $secretAnswer;
  }

  public function launch()
  {
    $login = $this->login;
    $password = $this->password;
    $password_bis = $this->passwordBis;
    $email = $this->email;
    $emailParent = $this->emailParent;
    $firstName = $this->firstName;
    $lastName = $this->lastName;
    $choiceNumber = $this->choiceNumber;
    $secretAnswer = $this->secretAnswer;

    if( $this->controlValue == 1)//If the child is agree with the terms of use
    {

      if($this->model->register($login, $password, $password_bis, $email, $firstName, $lastName, $emailParent, $choiceNumber, $secretAnswer) == true) // If the registration succeed
      {
        $this->view->setValue('HomePage');
      }
      else
      {
        $this->view->setValue('Register');
      }
    }

    else
    {
      $this->model->setError("Tu dois accepter les conditions d'utilisation et être membre de l'école pour pouvoir t'inscrire !");
      $this->view->setValue('Register');
      $this->model->setValError(0);
    }
    $this->view->launch($this->model->getError(), $this->model->getValError());
    $this->view->foot();

  }

}
?>

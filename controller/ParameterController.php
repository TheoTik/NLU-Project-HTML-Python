<?php
include("model/ChildDbModel.php");

class ParameterController extends Controller{
	public $title;
	public $author;
	public $content;
	public $changeValue;
	public $newPassword;
	public $newPassword2;
	public $newLogin;

	public function __construct($login, $password, $changeValue, $newPassword, $newPassword2, $newLogin){
		parent::__construct($login);
		$this->model = new ChildDbModel;
		$this->login = $login;
		$this->password = $password;
		$this->changeValue = $changeValue;
		$this->newPassword = $newPassword;
		$this->newPassword2 = $newPassword2;
		$this->newLogin = $newLogin;
	}

	public function launch(){
		if($this->changeValue == 1){ //If a change of password is required
			if($this->model->changePassword($this->login, $this->password, $this->newPassword, $this->newPassword2) == true )
			{
				$this->model->setError("Ton mot de passe a bien été modifié!");
				$this->model->setValError(1);
			}
			else
			{
				$this->model->setError("Impossible de modifier ton mot de passe, tu t'es peut être trompé de nom d'utilisateur ou de mot de passe !");
				$this->model->setValError(0);
			}
		}
		elseif($this->changeValue == 2){// If we want to just change the login
			if($this->model->changeLogin($this->login, $this->password, $this->newLogin) == true )
			{
				$this->model->setError("Ton nom d'utilisateur a bien été modifié!");
				$_SESSION['login'] = $this->newLogin;
				$this->model->setValError(1);
			}
			else{
				$this->model->setError("Impossible de modifier ton nom d'utilisateur !");
				$this->model->setValError(0);
			}
		}

		$this->view->setValue('Parameter');
		$this->view->launch($this->model->getError(),$this->model->getValError());
		$this->view->foot();
	}

}
?>

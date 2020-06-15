<?php

include("model/MessageDbModel.php");

class MessageController extends Controller{

  public function __construct($login, $erase, $id)
  {
    parent::__construct($login);
    $this->model = new MessageDbModel();
    $this->erase = $erase; // If the value of erase is 1 it means that we want to delete
    $this->id = $id;
  }


  public function launch(){
    if($this->erase == 1){ //If we want to delete a message
      $this->model->deleteMessage($this->login, $this->id);
    }
    $this->view->launchMessage();
    $this->model->browseDataBase($this->view, $this->login);

    $this->view->foot();

  }
}
?>

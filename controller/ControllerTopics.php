<?php

require("model/ModelTopics.php");

class ControllerTopics extends Controller{

  public function __construct($login, $id, $erase){
    parent::__construct($login);
    $this->model = new ModelTopics;
    $this->login = $login;
    $this->id = $id;
    $this->erase = $erase;
  }

  public function launch(){
    $this->view->launchTopics("question", 0);
    if($this->erase == 1)
    { // Delete messaege
      $this->model->deletePost($this->login, $this->id,"", "question");
    }
    $this->model->browseDataBase($this->id, $this->view, "question");
    $this->view->foot();
  }
}
?>

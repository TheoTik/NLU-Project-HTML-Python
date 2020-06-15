<?php
require("model/ModelTopics.php");

class ResponseController extends Controller{
  public $id2;

  public function __construct($login,$id,$id_reponse,$erase){
    parent::__construct($login);
    $this->model = new ModelTopics;
    $this->login = $login;
    $this->id = $id;         // id corresponding to the topic
    $this->id2 = $id_reponse;  //id corresponding to the response
    $this->erase = $erase;
  }

  public function launch(){
    $this->view->launchTopics("response", $this->id); //launch the view of the response part of the topics
    if($this->erase == 1){
      $this->model->deletePost($this->login, $this->id,$this->id2, "response");  //delete the response of a topic
    }
    $this->model->browseDataBase($this->id, $this->view,"response");//view of the different responses
    $this->view->foot();
  }
}
?>

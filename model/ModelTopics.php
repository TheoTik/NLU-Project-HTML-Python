<?php

class ModelTopics extends Model{

  //Construct the function with fixed parameters
  public function __construct()
  {
    parent::__construct();
  }

  /*
  * Search in the database all the elements according to the SQL request, orderded by the date
  * display of the elements through view function
  */
  public function browseDataBase($id, $view, $type){
    if($type == "question"){  //depend on question table or response
      try {
        $reponse = $this->database->query('SELECT * FROM question ORDER BY Date_heure DESC'); //sort the element in the DB by the most rescent

        while ($donnees = $reponse->fetch()){
          $idtopic = $donnees['Id'];
          $nb = $this->database->query("SELECT COUNT(*) FROM response WHERE QuestionId = '$idtopic' ")->fetchColumn(); //get the number of response according to a topic
          $view->viewTopics($donnees['Id'],$donnees['Title'],$donnees['Content'],$donnees['Author'],$donnees['Date_heure'], $nb); //Get all attributes in the DB
        }
        $reponse->closeCursor();  //free the connexion
      }
      catch(PDOException $e)
      {
        die('Erreur : '.$e->getMessage());
      }
    }else{
      try {
        $reponse = $this->database->query("SELECT * FROM response WHERE QuestionId='$id' ORDER BY TimeH DESC;"); //sort the element in the DB by the most rescent

        while ($donnees = $reponse->fetch()){
          $view->viewResponse($donnees['Content'],$donnees['Author'],$donnees['TimeH'],$donnees['QuestionId'], $donnees['Id'] ); //Get all attributes in the DB
        }
        $reponse->closeCursor();  //free the connexion
      }
      catch(PDOException $e)
      {
        die('Erreur : '.$e->getMessage());
      }
    }
  }

  /*
  * add elements in the database
  */

  public function addDataBase($id, $title, $author, $content,$type){
    $dt = date('Y-m-d H:i:s');  //get the date for the SQL request
    $encodedTitle = htmlspecialchars($title, ENT_QUOTES); //encode the input to make sure there is no XSS injections
    $encodedContent = htmlspecialchars($content, ENT_QUOTES);
    if($type == "question"){
      try {
        $sql_prepare = $this->database->query("SELECT * FROM `question` WHERE Title='$encodedTitle' AND Content='$encodedContent';"); //SQL request to test if we already commit the same content
        $donnees = $sql_prepare->fetch();
        $sql_prepare->closeCursor();  //free the connexion
        if(!$donnees && $content != "" && $author != ""){  //if the result of the SQL request is false = we don't have it in the DB
          $sql = ("INSERT INTO question (Content,Title,Date_heure,Author) VALUES ('$encodedContent', '$encodedTitle', '$dt', '$author');"); //Insertion of a new topics
          $stmt= $this->database->prepare($sql); //to avoid injections
          $stmt->execute();
          return true;
        }
        $this->setError("Ce topic existe déjà.");
        $this->setValError(1);
        return false;
      }
      catch(PDOException $e){
        die('Erreur : '.$e->getMessage());
      }
    }else if($type == "response"){
      try {
        $sql_prepare = $this->database->query("SELECT * FROM `response` WHERE Author ='$author' AND Content='$encodedContent' AND QuestionId = '$id';"); //SQL request to test if we already commit the same content
        $donnees = $sql_prepare->fetch();
        $sql_prepare->closeCursor();  //free the connexion
        if(!$donnees && $content != ""){  //if the result of the SQL request is false = we don't have it in the DB
          $sql = ("INSERT INTO response (Content,QuestionId,TimeH,Author) VALUES ('$encodedContent', '$id', '$dt', '$author');"); //Insertion of a new topics
          $stmt= $this->database->prepare($sql); //to avoid injections
          $stmt->execute();
          return true;
        }
        return false;
      }
      catch(PDOException $e){
        die('Erreur : '.$e->getMessage());
      }
    }
  }

  /*
  * delete a post, whether it s a topic or a response
  */
  public function deletePost($login, $id, $id2, $type){ //delete a post -> topic / response
    $sql= ("DELETE FROM question WHERE `Author` = '$login' AND `Id` = '$id' ");   //delete line in the DB
    $sql2= ("DELETE FROM response WHERE `QuestionId` = '$id' ");  //delete line in the DB
    $sql3= ("DELETE FROM response WHERE `Author` = '$login' AND `Id` = '$id2'");  //delete line in the DB
    try{
      if($type == "question"){  //If we are in the main post, delete the post itself and they associated responses
        $this->database->query($sql);  //exec the request and return the result if it exists
        $this->database->query($sql2);
      }else{
        $this->database->query($sql3);
      }

    }
    catch(Exception $e){
      echo $e->getMessage();
    }

  }

}

?>

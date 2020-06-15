<?php

class MessageDbModel extends Model
{

  public function __construct()
  {
    parent::__construct();
  }

  /*
  * To print all the messages corresponding to the login
  */
  public function browseDataBase($view, $login){
    try {
      $reponse = $this->database->query("SELECT * FROM `Message` WHERE `To` = '$login' ");

      while($donnees = $reponse->fetch()){

        $view->messagesReceived($donnees['To'],$donnees['author'],$donnees['title'],$donnees['content'],$donnees['date'], $donnees['Id']); //Get all attributes in the DB
      }
      $reponse->closeCursor();  //free the connexion
    }
    catch(PDOException $e)
    {
      die('Erreur : '.$e->getMessage());

    }
  }

  /*
  * To check is someone is already registered with the login $login
  */
  public function existLogin($login){

    $sql = ("SELECT * FROM `child` WHERE login='$login'");
    $response = $this->database->query($sql);
    $data = $response->fetch();

    if (!$data)
    {
      return false;
    }
    else
    {
      return true;
    }
  }


  /*
  * To send the message to $to with the title $title and the content $content
  */
  public function sendMessage($to, $login, $title, $content){
    $date = date('Y-m-d H:i:s');
    $encodedContent = htmlspecialchars($content, ENT_QUOTES); //to prevent XSS injections
    $encodedTitle = htmlspecialchars($title, ENT_QUOTES);
    if($to != $login && $this->existLogin($to)){ // If the login exist and the receiver is not the sender
      $sql= ("INSERT INTO Message VALUES('$to', '', '$login', '$encodedTitle', '$encodedContent', '$date' )");

      try
      {
        $requete_preparee = $this->database->prepare($sql);
        $requete_preparee->execute();
      }
      catch(Exception $e)
      {
        echo $e->getMessage();
      }

      $this->setError("Ton message a bien été envoyé");
      $this->setValError(1);
    }
    elseif($this->existLogin($to) == false){// If the login does not exist
      $this->setError("Tu ne peux pas envoyer un message à un utilisateur qui n'existe pas !");
      $this->setValError(0);
    }
    else{
      $this->setError("Tu ne peux pas t'envoyer de message à toi même !");
      $this->setValError(0);
    }
  }

  /*
  * To delete the message corresponding to the id $id
  */
  public function deleteMessage($login, $id)
  {
    $sql= ("DELETE FROM Message WHERE `To` = '$login' AND `Id` = '$id' ");

    try
    {
      $this->database->query($sql);
    }
    catch(Exception $e)
    {
      echo $e->getMessage();
    }

  }

}


?>

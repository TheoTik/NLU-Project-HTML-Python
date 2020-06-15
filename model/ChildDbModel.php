<?php

class ChildDBModel extends Model
{

  public function __construct()
  {
    parent::__construct();
  }

  /*
  *To check if the $password of the username login is correct
  *return true if the password associated to the username login is correct
  */
  public function checkLogin($login, $password)
  {

    $database = $this->getDataBase() or die("La connexion à la base de données a échoué!");
    try
    {
      $query = $database->query("SELECT * FROM `child` WHERE login ='$login '");
      $res = $query->fetch();

      $loginSearch = $res['login'];
      $pwd = $res['password'];
    }


    catch(Exception $e)
    {
      echo $e->getMessage();
    }

    $pw_check = password_verify($password, $pwd);	//verifie que le mdp existe
    if($loginSearch == $login && $pw_check == true)
    {
      $query->closeCursor();
      return true;
    }
    else
    {
      $this->setError("Mot de passe ou nom d'utilisateur invalide!");
      $this->setValError(0);
      $query->closeCursor();
      return false;
    }

  }

  /* To search if the username login is already registered or
  * return true if the username already exists in the database
  */
  public function isRegister($login)
  {
    $database = $this->getDataBase() or die("La connexion à la base de données a échoué!");

    try
    {
      $query = $database->query("SELECT * FROM `child` WHERE login ='$login '");
      $res = $query->fetch();
      $loginSearch = $res['login'];
    }
    catch(Exception $e)
    {
      echo $e->getMessage();
    }

    if($loginSearch == $login )
    {
      $query->closeCursor();
      return true;
    }
    else
    {
      $query->closeCursor();
      return false;
    }
  }

  /*
  * To know the number of registred child for an $emailParent
  * @return the number of registred child with the email parent $emailParent
  */
  public function howManyChildRegistered($emailParent){
    $database = $this->getDataBase();

    $query = $database->query("SELECT * FROM `child` WHERE `emailparent` = '$emailParent' ");
    $query->execute();
    $count = $query->rowCount();

    return $count;

  }

  /*
  * To know the number of registred child wit the same login
  * @return the number of registred child with same login
  */
  public function howManySameLogin($login){
    $database = $this->getDataBase();

    $query = $database->query("SELECT * FROM `child` WHERE `login` = '$login' ");
    $query->execute();
    $count = $query->rowCount();

    return $count;
  }

  /*
  * To register a new member with his login, password, firstname, lastname and email and the secret question he choose with his answer
  */
  public function register($login, $password, $passwordBis, $email, $firstName, $lastName, $emailParent, $choiceNumber, $secretAnswer)
  {
    $secretQuestion = '';

    switch($choiceNumber)
    {
      case 'one':
      $secretQuestion = 'Quel est le nom de ton animal de compagnie ?';
      break;
      case 'two':
      $secretQuestion = 'Quel est le nom de ton super-héros préféré ?';
      break;
      default:
      $secretQuestion = 'Quel est ton dessin animé préféré ?';
      break;
    }

    if($this->isRegister($login) == true)
    {
      $this->setError("Nom d'utilisateur déjà utilisé, tu es déjà inscrit!");
      $this->setValError(0);
      return false;
    }
    else if($password != $passwordBis)
    {
      $this->setError('Les mots de passes ne correspondent pas');
      $this->setValError(0);
      return false;
    }
    else
    {
      $database = $this->getDataBase();
      $query1 = $database->query("SELECT `email` FROM `parent` WHERE `email` = '$emailParent'");
      $res1= $query1->fetch();

      if($res1 == null)
      {
        return false;
      }

      $query2 = $database->query("SELECT `number_of_child` FROM `parent` WHERE `email` = '$emailParent'");
      $res2 = $query2->fetch();

      $numberOfChild = $res2['number_of_child'];

      if(($emailParent != $res1['email'] || $this->howManyChildRegistered($emailParent) == $numberOfChild))
      {
        $this->setError("L'adresse mail de tes parents n'est pas bonne");
        $this->setValError(0);
        return false;
      }

      $hashPw = password_hash($password, PASSWORD_DEFAULT);
      $sql= ("INSERT INTO child VALUES('$login', '$hashPw', '$email', '$firstName', '$lastName', '$emailParent', '$secretQuestion', '$secretAnswer')");

      try
      {
        $prepared_request2 = $database->prepare($sql);
        $prepared_request2->execute();
        $this->setError("Tu es bien inscrit, tu peux maintenant te connecter!");
        $this->setValError(1);
        return true;

      }
      catch(Exception $e)
      {
        echo $e->getMessage();
      }
    }
  }

  /*
  * To change the password, we check is the password are correct and if newPasswors is equal to newPassword2
  */
  public function changePassword($login, $password, $newPassword, $newPassword2 )
  {
    if($this->checkLogin($login, $password) == true && ($newPassword == $newPassword2))
    {
      $database = $this->getDataBase();
      $hashPw = password_hash($newPassword, PASSWORD_DEFAULT);
      $request = $database->prepare("UPDATE `child` SET password = '$hashPw' WHERE login = '$login'");
      $request->execute();
      return true;
    }
    else
    {
      return false;
    }
  }

  /*
  * To change the login, if a child is alrealdy registered with this login, the login can not be changed
  * It aldo update the messages beacause they have to follow the receiver even if he change his login
  */
  public function changeLogin($login, $password, $newLogin)
  {
    if($this->howManySameLogin($newLogin) >= 1 ){
      return false;
    }
    elseif($this->checkLogin($login, $password) == true)
    {
      $database = $this->getDataBase();
      $request = $database->prepare("UPDATE `child` SET login = '$newLogin' WHERE login = '$login' ");
      $request->execute();
      $request = $database->prepare("UPDATE `Message` SET `To` = '$newLogin' WHERE `To` = '$login' ");
      $request->execute();
      return true;
    }
    else
    {
      return false;
    }

  }

  /*
  * To réinitialise the password if a child forget his password
  */
  public function resetPassword($login, $newPassword, $newPassword2)
  {
    if(($newPassword == $newPassword2))
    {
      $database = $this->getDataBase();
      $hashPw = password_hash($newPassword, PASSWORD_DEFAULT);
      $request = $database->prepare("UPDATE `child` SET password = '$hashPw' WHERE login = '$login'");
      $request->execute();
      return true;
    }
    else
    {
      return false;
    }
  }

  /*
  *To find what was the secret question associated with the name $login
  */
  public function whatWasTheSecretQuestion($login){
    $database = $this->getDataBase();
    $request = $database->query("SELECT `secretQuestion` FROM `child` WHERE `login` = '$login'");
    $res = $request->fetch();
    return $res['secretQuestion'];
  }

  /*
  * To verify if the answer to the question is correct and is the same whe saved
  */
  public function verifySecreteAnswer($login, $secretAnswer){
    $database = $this->getDataBase();
    $request = $database->query("SELECT `secretAnswer` FROM `child` WHERE `login` = '$login'");
    $res = $request->fetch();
    $answer =$res['secretAnswer'] ;
    if($answer == $secretAnswer)
    {
      $this->setError("Tu peux réinitialiser ton mot de passe");
      $this->setValError(1);
      return true;
    }
    else
    {
      $this->setError("Ce n'est pas la bonne réponse !");
      $this->setValError(0);
      return false;
    }

  }

}


?>

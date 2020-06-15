<?php

class Model
{
  private $login;
  private $password;
  protected $database;
  private $error;
  private $valError;
  private $passwordBis;
  
  public function __construct()
  {
    $this->setDataBase();
  }

  /*
  *To check if the $password of the username login is correct
  *return true if the password associated to the username login is correct
  */
  public function checkLogin($login, $password)
  {

    $database = $this->getDataBase() or die("Connexion to the database fails !");
    try
    {
      $query = $database->query("SELECT * FROM `User` WHERE password = '$password' AND login ='$login '");
      $res = $query->fetch();

      $loginSearch = $res['login'];
      $pwd = $res['password'];
    }
    catch(Exception $e)
    {
      echo $e->getMessage();
    }

    if($loginSearch == $login )
    {
      if($pwd == $password)
      {
        $query->closeCursor();
        return true;
      }
    }
    else
    {
      $this->setError("Password or Username invalid !");
      $this->setValError(1);
      $query->closeCursor();
      return false;
    }

  }

  /* To search if the username login is already registered or
  * return true if the username already exists in the database
  */
  public function isRegister($login)
  {
    $database = $this->getDataBase() or die("Connexion to the database fails !");

    try
    {
      $query = $database->query("SELECT * FROM `User` WHERE login ='$login '");
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


  /* To register a new member with his login, password, firstname, lastname and email
  */
  public function register($login, $password, $email, $firstName, $lastName)
  {
    if($this->isRegister($login) == true)
    {
      $this->setError("Username already used, you are already registerd !");
      $this->setValError(1);
      return false;
    }

    else
    {
      $database = $this->getDataBase();
      $sql= ("INSERT INTO User VALUES('$login', '$password', '$firstName', '$lastName', '$email')");

      try
      {
        $requete_preparee = $database->prepare($sql);
        $requete_preparee->execute();
        $this->setError("You have been registered successfully ! You can login now !");
        $this->setValError(0);
        return true;

      }
      catch(Exception $e)
      {
        echo $e->getMessage();
      }
    }
  }


  //GETTERS AND SETTERS
  public function setDataBase()
  {
    try
    {
      $this->database = new PDO( 'mysql:host=dbserver;dbname=dmenguy;port=3306;charset=utf8', 'dmenguy' , 'projet55', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
      die('Erreur : ' . $e->getMessage());
    }
  }

  public function getDataBase()
  {
    return $this->database;
  }

  public function getLogin()
  {
    return $this->login;
  }

  public function setLogin($login)
  {
    $this->login = $login;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }
  public function getError()
  {
    return $this->error;
  }

  public function setError($err)
  {
    $this->error = $err;
  }
  public function getValError()
  {
    return $this->valError;
  }

  public function setValError($err)
  {
    $this->valError = $err;
  }


}


?>

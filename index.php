<?php
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60*60))
{ // Session expired
  session_unset();
  session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();


require("controller/Controller.php"); // Import basic controller
$login="";
if(!empty($_SESSION['login'])){
  $login = $_SESSION['login'];  // User's login
}

$password= "";  // User's password
$password_bis= "";  // Password verification
$email = "";  // User's email
$firstName = "";  // User's name
$lastName = "";  // User's surname
$emailParent = "";  // User's parent email
$controlValue = 1; // By default the controValue is set to set to false

$controller= new Controller($login);  // Create basic controller

if ($_POST)
{ // To transform $task] in $task
  extract($_POST);
}

if(empty($task))
{    // Starting page, no task
  $controller->view->setValue('HomePage');
  $controller-> launch();
}

else // Action to do, depends on the task
{

  $controller->view->setValue($task);  // Load the next view

  if (file_exists('controller/'.$task.'.php'))
  {  // There is a associated controller
    require('controller/'.$task.'.php');

    switch($task)
    {
      case 'SignInController':
      if(isset($acceptedTermsUse) && isset($studentCertified))
      {
        $controlValue = 1;
      }
      $controller = new $task($login,$email,$password, $password_bis, $firstName, $lastName, $emailParent, $controlValue, $question, $secretAnswer);
      break;

      case 'MessageController':
      if(isset($erase)){
        $erase = 1;
        $id = $id;
      }
      else{
        $erase = 0;
        $id = "";
      }

      $controller = new $task($login, $password, $erase, $id);
      break;

      case 'ControllerTopics':
      if(isset($erase)){
        $erase = 1;
        $id = $id3;
      }
      else{
        $erase = 0;
        $id = "";
      }
      $controller = new $task($login,$id,$erase);
      break;

      case 'ControllerPost' :
      $controller = new $task($login);
      break;

      case 'ResponseController':
      if(isset($erase)){
        $erase = 1;
        $id = $id5;
        $id2 = $id4;
      }
      else{
        $erase = 0;
        $id = $id1;
        $id2 = "";
      }
      $controller = new $task($login,$id,$id2,$erase);
      break;

      case 'ControllerPostResponse':
      $controller = new $task($login,$id2);
      break;

      case 'SendMessageController':
      if(empty($to) && !empty($subject) && !empty($textMessage)){
        $to ="";
        $subject = "";
        $textMessage = "";
      }

      if($to == 'admin'){
        $contact = true;
      }
      else{
        $contact = false;
      }
      $controller = new $task($to, $login, $subject, $textMessage, $contact);
      break;

      case 'ParameterController':
      $changeValue= 0; //if we don't want to change anything

      if(!empty($password) && !empty($newPassword2) && !empty($newPassword)){
        $newPassword = $newPassword;
        $newPassword2 = $newPassword2;
        $changeValue = 1; //if we want to change the password
        $newLogin ="";
      }
      elseif(!empty($login) && !empty($newLogin) && !empty($password)){
        $newLogin = $newLogin;
        $changeValue = 2;
        $newPassword = "";
        $newPassword2 = "";
      }
      else
      {
        $newPassword = "";
        $newPassword2 = "";
        $newLogin ="";
      }
      $controller = new $task($login, $password, $changeValue, $newPassword, $newPassword2, $newLogin);
      break;
      case 'ForgetPasswordController':
      if(isset($secretAnswer)) // If we respond to the secret answer
      {
        $reset1 = 0;
        $choiceNumber = "";
        $secretAnswer = $secretAnswer;
        $newPassword = "";
        $newPassword2 = "";
      }
      else {
        if(!empty($login)){
          $username = $login;
          $reset1 = 3;
        }
        else{
          $username ="";
          $reset1 = 0;
        }
        $choiceNumber = "";
        $secretAnswer = "";
        $newPassword = "";
        $newPassword2 = "";
      }
      if(isset($reset)){ //If we choose the new password
        $reset1 = 1;
      }

      $controller = new $task($username, $secretAnswer, $reset1, $newPassword, $newPassword2);
      break;
      default:
      $controller = new $task($login, $password);
      break;
    }
    $controller->launch();
  }
  else {
    $controller->launch();
  }

}



?>

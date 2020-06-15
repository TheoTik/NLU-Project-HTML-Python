<?php
class DeconnectController extends Controller{

  public function launch()
  {  // Deconnect the user
    $_SESSION['login']= null; // Initialize session
    session_unset();
    session_destroy();
    $this->view->setValue('HomePage'); // Return to the Home page
    $this->view->launch("","");
    $this->view->foot();
    }
}

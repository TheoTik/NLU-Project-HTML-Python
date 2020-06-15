<?php

require("model/Model.php");
require("view/View.php");

class Controller
{  // base controller
  public $model;  // Associated model
  public $login; // User's login
  // public $password; // User's password
  public $view; // Associated view
  public $id; // id of topics
  public $erase; // check if we delete a message or a topic

  public function __construct($login)
  { // constructor of the base controller
    $this->view = new View;
    $this->login = $login;
  }



  public function launch()
  { // launch view
    $this->view->launch("","");
    $this->view->foot();
  }

  public function table($string)
  {  // Transform a string into a table of words
    $i=0;
    $j=0;
    $tab=null;
    while($string[$i] != "/")
    { // end of the string
      if($string[$i]!= "["  && $string[$i] != "]")
      {  // character different of [ and ]
        if($string[$i]== "'")
        { // Mark the words start
          $temp="'";
          $i=$i+1;
          while ($string[$i] != "'")
          { // Mark the words end
            $temp= $temp.$string[$i]; // Add letters
            $i=$i+1;
          }
          $tab[$j] =$temp."'";  // Add words
          $j=$j+1;
        }
      }
      $i=$i+1;
    }
    return $tab;
  }

  public function table2($string)
  { // Transform a string into a table of words list
    $i=0;
    $j=0;
    $tab=null;
    while($string[$i] != "/"){
      if($string[$i]!= "[" ){
        if($string[$i]== "'"){
          $temp="";
          $i=$i+1;
          while ($string[$i] != "]"){
            if($string[$i]!="'"){
              $temp= $temp.$string[$i];
            }
            $i=$i+1;
          }
          $tab[$j] =$temp;
          $j=$j+1;
        }
      }
      $i=$i+1;
    }
    return $tab;
  }

  public function clean($tab)
  { // Clean the shell_exec returns, transform it into an valable string
    $new="";
    $i=1; // exclude the first [
      while($tab[$i+3] != "/")
      {  // Exclude ] : that are at the end
        if($tab[$i]!= "["  && $tab[$i] != "]" && $tab[$i] != "'" && $tab[$i] != "," ){
          $new = $new.$tab[$i];
        }
        if( $tab[$i] == "]" || $tab[$i] == "["){
          $new= $new."'";
        }
        $i=$i+1;
      }
      return $new;
    }


    public function deleteBlackList($tab,$tab1)
    { // Delete words from $tab1 in $tab
      $new="";
      $i=0;
      for($i=0; $i<sizeof($tab); $i=$i+1){
        $count=0;
        $j=0;
        for($j=0; $j<sizeof($tab1); $j=$j+1){
          if($tab[$i] == $tab1[$j]){
            $count=$count+1;
          }
        }

        if($count == 0){
          $new=$new.($tab[$i]." ");
        }
      }
      return $new." /";
    }

  }

  ?>

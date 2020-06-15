<?php

include("model/MessageDbModel.php");

class SendMessageController extends Controller{
  public $to;
  public $title;
  public $content;
  public $contact;
  public $send;

  public function __construct($to, $login, $title, $content, $contact)
  {
    parent::__construct($login);
    $this->model = new MessageDbModel();
    $this->to = $to;
    $this->title = $title;
    $this->content =$content;
    $this->contact = $contact;
  }


  public function launch()
  {
    // detect words that are not in whitelist;
    $NotInWhiteList=(shell_exec("./whitelist.py $this->title $this->content 2>>error.log" ))." /";

    // clean the string to use it in shell_exec;
    $NotInWhiteListClean= $this->clean($NotInWhiteList);

    // detect words in blacklist from the $NotInWhiteList string;
    $blacklist=(shell_exec("./blacklist.py $NotInWhiteListClean 2>>error.log" ))." /";

    //transform string into table;
    $tabNotInWhiteList = ($this->table($NotInWhiteList));
    $tabBlackList = ($this->table($blacklist));
    // test if there is blacklisted words;
    if($tabBlackList[0]==[]){
      $ToCorrect=$NotInWhiteListClean;
      $tabToCorrect=$tabNotInWhiteList;
    }
    // to isolate words to correct;
    else{
      $ToCorrect=$this->deleteBlackList($tabNotInWhiteList, $tabBlackList);
      $tabToCorrect = $this->table($ToCorrect);
    }

    // create a suggestion list;
    $correct=(shell_exec("./correct.py $ToCorrect 2>>error.log" ))." /";

    // string into table;
    $tabCorrect= $this->table2($correct);

    // add the topics if there is no error;
    if(empty($tabNotInWhiteList)){
      $this->model->sendMessage($this->to, $this->login, $this->title, $this->content);

      // If we want to contact the admin we are redirect to the admin contact page
      if($this->contact == true && $this->to != $this->login )
      {
        $this->view->setValue('Contact');
        $this->view->launch("Ton message a bien été envoyé!", 1);
      }

      else
      {
        //If the receiver is the same as the sender
        if($this->to == $this->login ){

          $this->view->setValue('Message');
          $this->view->launch($this->model->getError(), $this->model->getValError());
          $this->model->browseDataBase($this->view, $this->login);

        }
        //If we are not the receiver
        elseif($this->to != $this->login ){
          $this->view->setValue('Message');
          $this->view->launch($this->model->getError(), $this->model->getValError());
          $this->model->browseDataBase($this->view, $this->login);
        }

        else{
          $this->view->setValue('Message');
          $this->view->launchMessage();
          $this->model->browseDataBase($this->view, $this->login);

        }

      }
    }
    else{
      if($this->contact == false){
        $this->view->launchMessage();
        // print all errors to correct;
        $i=0;
        while(!(empty($tabToCorrect[$i]))){
          if ($tabCorrect[$i]!="None"){
            $this->view->error("'".$tabToCorrect[$i]."' à corriger. Remplacer par : ".$tabCorrect[$i], 0);
          }
          else {
            $this->view->error("'".$tabToCorrect[$i]."' à corriger. Pas de correction possible dans la liste blanche", 0);
          }
          $i=$i+1;
        }
        //print all the badwords to eradicate;
        $j=0;
        while(!(empty($tabBlackList[$j]))){
          $this->view->error("'".$tabBlackList[$j]."' interdit, à supprimer.", 0);
          $j=$j+1;
        }
        $this->model->browseDataBase($this->view, $this->login);
      }
      else{
        $this->view->setValue('Contact');
        $this->view->launch("Ton message n'a pas été envoyé!", 0);
        // print all errors to correct;
        $i=0;
        while(!(empty($tabToCorrect[$i]))){
          if ($tabCorrect[$i]!="None"){
            $this->view->error("'".$tabToCorrect[$i]."' à corriger. Remplacer par : ".$tabCorrect[$i], 0);
          }
          else {
            $this->view->error("'".$tabToCorrect[$i]."' à corriger. Pas de correction possible dans la liste blanche", 0);
          }
          $i=$i+1;
        }
        //print all the badwords to eradicate;
        $j=0;
        while(!(empty($tabBlackList[$j]))){
          $this->view->error("'".$tabBlackList[$j]."' interdit, à supprimer.", 0);
          $j=$j+1;
        }

      }
      $this->view->foot();
    }


  }



}
?>

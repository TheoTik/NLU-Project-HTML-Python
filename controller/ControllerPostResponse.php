<?php
require("model/ModelTopics.php");

class ControllerPostResponse extends Controller{
  public $title;
  public $author;
  public $content;

  public function __construct($login,$id){
    parent::__construct($login);  //call of the parent constructor
    $this->model = new ModelTopics;
    $this->title = "";  //no need title for the response so set to empty string
    $this->author = $login;
    $this->content = $_POST['content'];
    $this->id = $id;
  }

  public function launch(){
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

    $this->view->launchTopics("response",$this->id); //launch the view to add a new response

    if(empty($tabNotInWhiteList)){
      $this->model->addDataBase($this->id, $this->title, $this->author, $this->content, "response");	//add a new subject i.e topic
    }
    else{
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
    $this->model->browseDataBase($this->id, $this->view, "response");  //browse and display of all the reponses corresponding to the topic
    $this->view->foot();  //view of the footer in the forum page
  }

}

?>

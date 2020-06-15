<?php

require("model/ModelTopics.php");

class ControllerPost extends Controller{	// Controller for posting new subject in the forum
	public $title; // Title of the topic
	public $author; // Author of the topic
	public $content; // Text wrote

	public function __construct($login){
		parent::__construct($login);
		$this->model = new ModelTopics;		// Model corresponding to the topics and the responses
		$this->title = $_POST['title'];
		$this->author = $login;
		$this->content = $_POST['content'];
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


		$this->view->error($this->model->getError(),$this->model->getValError());
		$this->view->launchTopics("question",1);	//launch the view to add a new topic

		// add the topics if there is no error;
		if(empty($tabNotInWhiteList)){
			$this->model->addDataBase(0, $this->title, $this->author, $this->content, "question");	//add a new subject i.e topic
		}
		else{
			// print all errors to correct;
			$i=0;
			while(!(empty($tabToCorrect[$i])))
			{
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
		$this->model->browseDataBase(null, $this->view, "question");	//browse and display of all the topics
		$this->view->foot();	//view of the footer in the forum page
	}

}

?>

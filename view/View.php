<?php

class View{

  private $value;
  protected $error;
  private $id;


  public function launch($error, $val){

    if (!empty($this->value))
    {
      include('partial/Head.php');              //view of the header
      $this->error($error, $val);
      include('page/'.$this->getValue().'.php');  //view of the page
    }
    else
    {
      include('index.php');
    }
  }

  public function error($error, $val)
  {
    if(!empty($error))
    {
      if($val == 1){
        echo <<<VIEW
        <center>
        <div class="alert alert-success" role="alert">$error</div>
        </center>
        VIEW;
      }
      else
      {
        echo <<<VIEW
        <center>
        <div class="alert alert-danger" role="alert">$error</div>
        </center>
        VIEW;
      }
    }
  }

  public function foot(){       //view of the footer
    include('partial/Foot.php');
  }


  public function getValue(){
    return $this->value;
  }

  public function getId(){
    return $this->id;
  }
  public function setValue($val){
    $this->value=$val;
  }


  public function __toString() {
    return ''.$this->value;
  }

  public function launchTopics($type, $id){   //launch the header and the part of the view for adding a new topic or a response
    include('partial/Head.php');
    if($type == "question"){    //question = main topic part, else = response part
      include('view/page/AddTopics.php');
    }else{
      echo <<<VIEW
      <!-- To ensure proper rendering and touch zooming for all devices -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      </head>

      <body>
      <form class="input-topics justify-content-center" action="index.php" method="POST">
      <div class="form-group">
      <label for="exampleFormControlTextarea1">Contenu de votre réponse</label>
      <textarea class="form-control" id="contenu" name='content' rows="3"></textarea>
      </div>

      <div class='col col-sm-push-7'>
      <button type="submit" name='task' value='ControllerPostResponse' class="btn btn btn-primary my-2 my-sm-0">Ajouter la réponse</button>
      <input name='id2' value=$id type="hidden"></input>
      </div>
      </form>
      </body>
      VIEW;
    }
  }

  public function launchMessage(){
    include('partial/Head.php');
    include('view/page/Message.php');
  }

  public function viewTopics($id, $title, $content, $author, $date, $nb_messages){
    echo <<<VIEW
    <body>
    <form class="input-topics justify-content-center" action="index.php" method="POST">
    <!-- 2EME INDEX -->
    <!-- Forum school subject chart -->
    <div class="mt-3 px-1 pt-3 pb-none bg-primary rounded shadow-sm">

    <table class="table rounded media text-muted pt-3">

    <!-- First row of the chart -->
    <!-- One can play with the column-widths knowing that the total width of the table is 12 -->
    <div class="row border-bottom border-gray bg-light mx-1">
    <div class="col-7">

    <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

    <p class="media-body pb-3 mb-0 lh-125">
    <strong class="d-block text-gray-dark pl-13"><a>$title</a></strong> $content

    </p>
    <button name='task' value='ResponseController' class="btn btn btn-primary my-2 my-sm-0" type="submit"> Voir les réponses</button>
    <input name='id1' value=$id type="hidden"></input>
    </div>

    <div class="col-1">
    <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

    <p class="media-body pb-3 mb-0 lh-125">
    <strong class="d-block text-gray-dark text-center pr-2">$nb_messages</strong>messages
    </p>
    </div>

    <div class="col-1">
    <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
    <a href="#"><img src="view/images/student9_icon.png" class="d-block text-center" width="50px" /></a>
    </div>

    <div class="col-3">
    <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

    <p class="media-body small pb-3 mb-0 lh-125">
    Rédigé par <a href="#">$author</a>
    <span class="badge badge-success">Student</span> $date
    </p>
    </form>
    <form class="input-topics justify-content-center" action="index.php" method="POST">
    <div class="col-1">
    <input name='id3' value=$id type="hidden"></input>
    <input name='erase' type="hidden"></input>
    <button type="submit" class="btn btn-light" name='task' value='ControllerTopics'> suppression </button>
    </div>
    </form>
    </div>
    </table>
    </div>
    </body>
    VIEW;

  }
  public function messagesReceived($to, $author, $title, $content, $date, $id){
    echo <<<VIEW
    <body>
    <!-- 2EME INDEX -->
    <!-- Forum school subject chart -->
    <div class="mt-1 px-1 pt-1 pb-none bg-info rounded shadow-sm">

    <table class="table rounded media text-muted pt-1">

    <!-- First row of the chart -->
    <!-- One can play with the column-widths knowing that the total width of the table is 12 -->
    <div class="row border-bottom border-gray bg-light mx-1">
    <div class="col-7">

    <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

    <p class="media-body pb-3 mb-0 lh-125">
    <strong class="d-block text-gray-dark pl-13"><a href="forum_rules.html">$title</a></strong> $content
    </p>

    </div>

    <div class="col-3">
    by <a href="#">$author</a> $date
    </p>
    </div>
    <form class="input-topics justify-content-center" action="index.php" method="POST">
    <div class="col-1">
    <input name='id' value=$id type="hidden"></input>
    <input name='erase' type="hidden"></input>
    <button type="submit" class="btn btn-light" name='task' value='MessageController'> suppression </button>
    </div>
    </form>

    </div>
    </div>
    </table>
    </div>
    </body>
    VIEW;

  }

  public function viewResponse($content, $author, $date, $id, $id2){

    echo <<<VIEW
    <body>
    <!-- 2EME INDEX -->
    <!-- Forum school subject chart -->
    <div class="mt-3 px-1 pt-3 pb-none bg-primary rounded shadow-sm">

    <table class="table rounded media text-muted pt-3">

    <!-- First row of the chart -->
    <!-- One can play with the column-widths knowing that the total width of the table is 12 -->
    <div class="row border-bottom border-gray bg-light mx-1">
    <div class="col-7">

    <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

    <p class="media-body pb-3 mb-0 lh-125">
    $content
    </p>

    </div>

    <div class="col-1">
    <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
    <a href="#"><img src="view/images/student9_icon.png" class="d-block text-center" width="50px" /></a>
    </div>

    <div class="col-3">
    <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

    <p class="media-body small pb-3 mb-0 lh-125">
    Rédigé par <a href="#"> $author</a>
    <span class="badge badge-success">Student</span> $date
    <form class="delete-topics justify-content-center" action="index.php" method="POST">
    <input name='erase' type="hidden"></input>
    <input name='id4' value=$id2 type="hidden"></input>
    <input name='id5' value=$id type="hidden"></input>
    <button type="submit" class="btn btn-light" name='task' value='ResponseController'> suppression </button>
    </p>
    </div>
    </form>
    </table>
    </div>
    </body>

    VIEW;

  }
  public function launchForgetPassword($question, $login){
    include('partial/Head.php');
    echo <<<VIEW
    <main role="main" class="container text-center bg-light px-5 py-5">
    <div class="bg-warning rounded p-3">
    <div class="bg-light rounded p-5">

    <body class="bg-light ">

    <form action ="index.php" method="POST">

    <p> Il faut que tu réponde à la même question secrète que pendant ton inscription, attention ne te trompe pas dans la réponse!</p>
    <p> $question </p>
    <br />
    <div class="form-row justify-content-center">

    <div class="col-md-4 mb-3">

    <input type="text" class="form-control" name="secretAnswer" id="secretAnswer" placeholder="Réponse secrète" required autofocus pattern="[a-zA-Z]+">

    <br />
    <input type="hidden" name="username" value="$login"> </input>
    <button type="submit" class="btn btn-primary btn-block col col-5" name="task" value= "ForgetPasswordController">Envoyer</button>
    <br />
    </div>
    </div>
    </div

    </div>
    </form>

    </div>
    </div>
    </main>
    </body>
    VIEW;

  }

  public function resetPassword($login){
    include('partial/Head.php');
    echo <<<VIEW
    <main role="main" class="container text-center bg-light px-5 py-5">
    <div class="bg-warning rounded p-3">
    <div class="bg-light rounded p-5">

    <body class="bg-light ">
    <form action ="index.php" method="POST">

    <!-- Change password part -------->

    <h4><FONT face="Verdana">Réinitialisation de mot de passe</FONT></h4>
    <input type="hidden" name="reset" > </input>
    <input type="hidden" name="username" value="$login"> </input>
    <label for="inputPassword" class="font-weight-bold">Mon nouveau mot de passe</label>

    <input type="password" data-toggle="tooltip" title="Veuillez saisir au moins 8 caractères dont un chiffre, une majuscule et une minuscule!" class="form-control"  name="newPassword"  id="inputPassword" placeholder="Mot de passe" required autofocus pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
    <br />

    <label for="inputPassword" class="font-weight-bold"> Confirme ton nouveau mot de passe </label>
    <input type="password" data-toggle="tooltip" title="Veuillez saisir au moins 8 caractères dont un chiffre, une majuscule et une minuscule!" class="form-control"  name="newPassword2"  id="inputPassword" placeholder="Mot de passe" required autofocus pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
    <br />
    <button type="submit" class="btn btn-primary btn-block col col-4" name="task" value="ForgetPasswordController">Envoyer</button>
    <br />
    </div>
    </form>
    </div>
    </div>

    </main>
    </body>
    VIEW;

  }
}
?>

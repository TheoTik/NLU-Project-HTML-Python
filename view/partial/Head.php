<html>
    <head>
	<!-- Affichage correct des accents -->
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


        <title>Forum de discussion du lac de l'ours</title>

	<!-- To include CSS and JS from Bootstrape -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<!-- To ensure proper rendering and touch zooming for all devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    </head>

    <body class="bg-light">

	<!-- Placing a navbar of dark color starting with a little school image -->
	<header>
    <?php if(isset($_SESSION['login'])){
      echo <<<VIEW
        <script language="javascript" type='text/javascript'>
            function session(){
              window.location="index.php";
            }
            setTimeout("session()",1000*60*60);
        </script>
VIEW;
          }
    ?>

    <form id="mainForm" action="index.php" method="POST">


      <input type="hidden" id="mainFormTaskInput" name="task" />
	     <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		       <img src="view/images/school.png" width="40px" />

	<!-- Grouping navbar content -->
  	<div class="collapse navbar-collapse" id="navbarSupportedContent">

		<!-- navbar option menu link list -->
 		<ul class="navbar-nav mr-auto">

      			<li class="nav-item active ml-4 mr-1">
        			<a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
      			</li>


      			<li class="nav-item ml-1 mr-1">
       				<a class="nav-link" href="#" onclick="$('#mainFormTaskInput').val('Faq'); $('#mainForm').submit();">FAQ</a>
      			</li>

      			<li class="nav-item ml-1 mr-1">
              <a class="nav-link" href="#" onclick="$('#mainFormTaskInput').val('Rules'); $('#mainForm').submit();">Règles d'utilisation</a>
      			</li>

      			<li class="nav-item ml-1 mr-1">
              <a class="nav-link" href="#" onclick="$('#mainFormTaskInput').val('Contact'); $('#mainForm').submit();">Contact</a>
      			</li>

    		</ul>

		<div class="form-inline my-2 my-lg-0">

      <?php if(isset($_SESSION['login'])){
        echo <<<VIEW

<div class='col col-sm-push-7'>
        <div class="container">

          <div class="dropdown">
            <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown"><img src="view/images/student_icon.png" width="25px" />
              $_SESSION[login]
            </button>

            <div class="dropdown-menu">
              <button class="dropdown-item" name="task" value="ParameterController">Paramètres du compte</button>
              <button class="dropdown-item" name="task" value="MessageController">Message</button>
            </div>
          </div>
        </div>
          </div>

            <button type="submit" name='task' value='DeconnectController' class="btn btn btn-primary my-2 my-sm-0">Deconnexion</button>

VIEW;

            }
            else {
          echo <<<VIEW

          <button type="submit" name='task' value='LogInPage' class="btn btn btn-primary my-2 my-sm-0">Connexion</button>
          	<button type="submit" name='task'  value='Register' class="btn btn btn-warning ml-2 my-sm-0">Inscription</button>
VIEW;
            }
            ?>



    		</div>

  	</div>

	 </nav>
  </form>
	</header>

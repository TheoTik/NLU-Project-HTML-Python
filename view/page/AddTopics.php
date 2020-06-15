<!-- To ensure proper rendering and touch zooming for all devices -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<form class="input-topics justify-content-center" action="index.php" method="POST">
	<h1><center>Poster un nouveau sujet</center></h1>
<div class="form-group">
<label for="exampleFormControlInput1">Titre</label>
<input type="text" class="form-control" id="titre" name='title'>
</div>
<div class="form-group">
<label for="exampleFormControlTextarea1">Contenu de votre sujet</label>
<textarea class="form-control" id="contenu" name='content' rows="3"></textarea>
</div>

<div class='col col-sm-push-7'>
<button type="submit" name='task' value='ControllerPost' class="btn btn btn-primary my-2 my-sm-0" type="submit">Poster le nouveau sujet</button>

<h1><center>Liste des sujets</center></h1>
</form>
</body>


<head>
<!-- Correct display of accents -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


	<title>Forum de discussion du lac de l'ours</title>

<!-- To include CSS and JS from Bootstrape -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<!-- To ensure proper rendering and touch zooming for all devices -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>

<!-- Centering everything in a block with main -->
<main role="main" class="container text-center bg-light px-5 py-5">

<!-- Two div to create a nice border for the form -->
<div class="bg-primary rounded p-4">
	<div class="bg-light rounded p-5">

		<!-- Registration form -->
		<form class="form-register m-5" action="index.php" method="POST">

			<img class="mb-4" src="view/images/school.png" alt="" width="100" height="100">
			<h1 class="h3 mb-3 font-weight-normal">Rejoins nous maintenant!</h1>
			<br /><br />


			<div class="form-row justify-content-center">

				<div class="col-md-4 mb-3">
					<label for="inputUsername" class="font-weight-bold">Nom d'utilisateur</label>

					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroupPrepend2">@</span>
						</div>
						<input type="text" class="form-control" name= "login" value="<?php if (isset($_POST['login'])){echo $_POST['login'];} ?>" id="inputUsername" placeholder="Nom d'utilisateur" minlength="3" maxlength="10" aria-describedby="inputGroupPrepend2" required autofocus pattern="[a-zA-Z]+">
						<small id="inputGroupPrepend2" class="form-text text-muted"> Nous vous conseillons d'utiliser votre nom. </small>
					</div>
				</div>

				<br />

				<div class="col-md-4 mb-3">
					<label for="inputPassword" class="font-weight-bold"> Mot de passe </label>
					<input type="password" data-toggle="tooltip" title="Veuillez saisir au moins 8 caractères dont un chiffre, une majuscule et une minuscule!" class="form-control" name="password" id="inputPassword" placeholder="Mot de passe" required autofocus pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
				</div>
			</div>

			<br />

			<div class="form-row justify-content-center">
				<div class="col-md-4 mb-3">
					<label for="inputPassword" class="font-weight-bold"> Retape ton mot de passe </label>
					<input type="password" class="form-control" name="password2" id="inputPassword" title="Veuillez saisir au moins 8 caractères dont un chiffre, une majuscule et une minuscule!" class="form-control" name="password" id="inputPassword" placeholder="Mot de passe" required autofocus pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
				</div>
			</div>

			<div class="form-row justify-content-center">

				<div class="col col-8">

					<label for="inputEmail" class="font-weight-bold">E-mail</label>
					<input type="text" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>" class="form-control" name="email" id="inputEmail" placeholder="E-mail" required autofocus pattern="[^@]+@[^.]+\.[^.]+">

				</div>
			</div>

			<div class="form-row justify-content-center">
				<div class="col col-8">

					<label for="inputEmail" class="font-weight-bold">E-mail des parents</label>
					<input type="text" class="form-control" value="<?php if (isset($_POST['emailParent'])){echo $_POST['emailParent'];} ?>" name="emailParent" id="inputEmail" placeholder="E-mail" required autofocus pattern="[^@]+@[^.]+\.[^.]+">

				</div>
			</div>
			<br />


			<div class="form-row justify-content-center">

				<div class="col-md-4 mb-3">

					<label for="inputFirstName" class="font-weight-bold pull-left" >Prénom</label>
					<input type="text" class="form-control" name="firstName" value="<?php if (isset($_POST['firstName'])){echo $_POST['firstName'];} ?>"id="inputFirstName" placeholder="Prénom" required autofocus pattern="[a-zA-Z]+">

				</div>

				<div class="col-md-4 mb-3">

					<label for="inputLastName" class="font-weight-bold">Nom</label>
					<input type="text" class="form-control" name="lastName" value="<?php if (isset($_POST['lastName'])){echo $_POST['lastName'];} ?>" id="inputLastName" placeholder="Nom" required autofocus pattern="[a-zA-Z]+">

				</div>

			</div>
			<br />

			<div class="form-row justify-content-center">
						<div class="col-md-6 nb-4 ">
				<label for="secretQuestion" class="font-weight-bold">Question secrète</label>

			<select class=form-control mutilple name="question">
				 <option value=one> Quel est le nom de ton animal de compagnie ? </option>
				 <option value=two> Quel est le nom de ton super-héros préféré ?</option>
				 <option value=three> Quel est ton dessin animé préféré ?</option>
				</select>

				<br />

					<input type="text" class="form-control" name="secretAnswer" id="secretAnswer" placeholder="Réponse secrète" required autofocus pattern="[a-zA-Z]+">
</div>


			</div>


			<!-- div included only to fix the left marging problem -->
			<div class="ml-4">
				<br />

				<div class="checkbox mx-5 mb-3 pl-5 text-left">
					<label>

						<input class="ml-5 pl-5" name="acceptedTermsUse" type="checkbox" value=1> J'ai lu et j'accepte les <a href="#">Conditions d'utilisation</a>
					</label>
					<br /><label>
						<input class="ml-5 pl-5" name="studentCertified" type="checkbox" value=2> Je certifie être un membre de l'école du lac de l'ours
					</label>
				</div>
				<br />

				<div class="row justify-content-center">

					<button class="btn btn-warning btn-block col col-2" name="task" value= "SignInController" type="submit">M'inscrire</button>

				</div>
			</div>

		</form>
	</div>
</div>

</main>

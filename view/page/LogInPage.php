	<!-- Log in form -->
	<!-- Centering everything in a block with main -->
	<main role="main" class="container text-center bg-light rounded px-5 py-5">

	<div class="bg-warning rounded p-4">
	<div class="bg-light rounded p-5">


	<form class="form-signin justify-content-center" action="index.php" method="POST">

		<img class="mb-4" src="view/images/school.png" alt="" width="100" height="100">
		<h1 class="h3 mb-3 font-weight-normal">Connecte toi!</h1>
		<br />

		<div class="row justify-content-center">

			<div class="col-md-4 mb-3">
      				<label for="inputUsername" class="font-weight-bold">Nom d'utilisateur</label>

					<div class="input-group">
						<div class="input-group-prepend">
          						<span class="input-group-text" id="inputGroupPrepend2">@</span>
						</div>
        					<input type="text" name='login' value="<?php if (isset($_POST['login'])){echo $_POST['login'];} ?>"" class="form-control" id="inputUsername" placeholder="Nom d'utilisateur" aria-describedby="inputGroupPrepend2" required autofocus>
					</div>
			</div>
		</div>

		<br />

		<div class="row justify-content-center">

			<div class="col-md-4 mb-3">
				<label for="inputPassword" class="font-weight-bold">Mot de passe</label>
      				<input type="password" name='password' class="form-control" id="inputPassword" placeholder="Mot de passe" required autofocus>
			</div>
		</div>

		<br />
		<div class="row justify-content-center">

			<button class="btn btn-primary btn-block col col-2" name= 'task' value='LogInController' type="submit" >Connexion</button>
		</div>
    	</form>

			<br />

			<form action = "index.php" method="POST">
				<a type="submit" href="#" onclick="$('#mainFormTaskInput').val('ForgetPassword'); $('#mainForm').submit();" class="btn btn-default">
					Mot de passe oublié
				</a>
			</form>
	</div>
	</div>

	</main>
	<br />
	<br />

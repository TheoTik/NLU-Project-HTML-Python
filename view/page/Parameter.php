
<main role="main" class="container text-center bg-light px-5 py-5">
  <div class="bg-warning rounded p-3">
    <div class="bg-light rounded p-5">

      <body class="bg-light ">

          <form class="form-register content-center" action="index.php" method="POST">
          <h3><FONT face="Verdana"> Paramètres du compte</FONT></h3>
          <br />
          Sur cette page vous pouvez changer votre nom d'utilisateur ou votre mot de passe.
          <br />
          <br />

            <!-- Change username part -------->
            <h4><FONT face="Verdana"> Changer mon nom d'utilisateur </FONT></h4>
            <br />

            <div class="form-row justify-content-center">
            <div class="col-md-4 mb-3">


            <label for="inputUsername" class="font-weight-bold">Nom d'utilisateur</label>

            <div class="input-group">

              <input type="text" class="form-control" name="login" id="inputUsername" placeholder="Nom d'utilisateur" minlength="3" maxlength="10" aria-describedby="inputGroupPrepend2" required autofocus pattern="[a-zA-Z]+">

            </div>

            <label for="inputUsername" class="font-weight-bold">Nouveau nom d'utilisateur</label>

            <div class="input-group">

              <input type="text" class="form-control" name= "newLogin" id="inputUsername" placeholder="Nom d'utilisateur" minlength="3" maxlength="10" aria-describedby="inputGroupPrepend2" required autofocus pattern="[a-zA-Z]+">

            </div>

            <label for="inputUsername" class="font-weight-bold">Mot de passe</label>

            <div class="input-group">
              <input type="password" data-toggle="tooltip" title="Veuillez saisir au moins 8 caractères dont un chiffre, une majuscule et une minuscule!" class="form-control" name="password" id="inputPassword" placeholder="Ancien mot de passe" required autofocus pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">

            </div>

            <br />
            <button type="submit" class="btn btn-primary btn-block col col-5" name="task" value= "ParameterController">Envoyer</button>
            <br />


          </form>
        </div>
      </div>
          <br />
            <!-- Change password part -------->

            <h4><FONT face="Verdana">Changer mon mot de passe</FONT></h4>

              <div class="form-row justify-content-center">
            <form class="form-register m-5" action="index.php" method="POST">

              <label for="inputUsername" class="font-weight-bold">Nom d'utilisateur</label>

              <div class="input-group">

                <input type="text" class="form-control" name= "login" id="inputUsername" placeholder="Nom d'utilisateur" minlength="3" maxlength="10" aria-describedby="inputGroupPrepend2" required autofocus pattern="[a-zA-Z]+">
              </div>

              <br />

            <label for="inputUsername" class="font-weight-bold">Mon ancien mot de passe</label>

            <div class="input-group">

              <input type="password" class="form-control" name= "password" id="inputUsername" placeholder="Ancien mot de passe" minlength="5" aria-describedby="inputGroupPrepend2" required autofocus pattern="[a-zA-Z0-9]*[0-9]+">
            </div>

            <br />

            <label for="inputPassword" class="font-weight-bold">Mon nouveau mot de passe</label>

            <input type="password" data-toggle="tooltip" title="Veuillez saisir au moins 8 caractères dont un chiffre, une majuscule et une minuscule!" class="form-control"  name="newPassword"  id="inputPassword" placeholder="Mot de passe" required autofocus pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
            <br />

            <label for="inputPassword" class="font-weight-bold"> Confirme ton nouveau mot de passe </label>
            <input type="password" data-toggle="tooltip" title="Veuillez saisir au moins 8 caractères dont un chiffre, une majuscule et une minuscule!" class="form-control"  name="newPassword2"  id="inputPassword" placeholder="Mot de passe" required autofocus pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
            <br />
            <button type="submit" class="btn btn-primary btn-block col col-4" name="task" value="ParameterController">Envoyer</button>
            <br />
          </div>
          </form>
        </div>
      </div>

  </main>
</body>

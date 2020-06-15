<main role="main" class="container text-center bg-light px-5 py-5">
  <div class="bg-warning rounded p-3">
    <div class="bg-light rounded p-5">

      <body class="bg-light ">

        <form class="form-register content-center" action="index.php" method="POST">
          <h3><FONT face="Verdana"> Récupération du nom d'utilisateur</FONT></h3>
          <br />
          Tu dois nous fournir ton nom d'utilsateur pour pouvoir réinitialiser ton mot de passe.
          <br />
          <br />

          <div class="form-row justify-content-center">
            <div class="col-md-4 mb-3">

              <label for="inputUsername" class="font-weight-bold">Nom d'utilisateur</label>

              <div class="input-group">

                <input type="text" class="form-control" name="login" id="inputUsername" placeholder="Nom d'utilisateur" minlength="3" maxlength="10" aria-describedby="inputGroupPrepend2" required autofocus pattern="[a-zA-Z]+">
              </div>


            </div>
          </div>
        <div class="form-row justify-content-center">
          <div class="col-md-4 mb-3">


          <button type="submit" class="btn btn-primary btn-block col col-5" name="task" value= "ForgetPasswordController">Envoyer</button>
        </div>
        </div>
      </form>
      </div>

    </div>


  </main>
</body>

  <main role="main" class="container text-center bg-light px-5 py-5">
    <div class="bg-success rounded p-3">
      <div class="bg-light rounded p-5">
        <form action ="index.php" method="POST">
        <h1><FONT face="Verdana"> Contacter un administrateur</FONT></h1>
        <br/>
        <br/>
        <p>Cette section est consacrée exclusivement aux problèmes rencontrés, à des dificultés de connexion ou encore à un quelconque dysfonctionnement du site.
          Vérifies que tu ne trouves pas la solution à ton problème dans la  <a href="#" onclick="$('#mainFormTaskInput').val('Faq'); $('#mainForm').submit();">FAQ</a>
          avant de contacter un administrateur. </p>
          <br/>

          <br/>
          <div class="form-row justify-content-center">

            <div class="col-md-4 mb-3">
              <input type="hidden" name='to' value='admin'></input>

              <label for="problemName" class="font-weight-bold pull-left">Sujet du problème rencontré</label>
              <input type="text" class="form-control" name="subject" required autofocus></input>

            </div>
          </div>
          <br />

          <div class="form-row justify-content-center">
            <div class="col col-8">

              <label for="textContact" class="font-weight-bold">Message</label>

              <textarea type="text" class="form-control" name="textMessage" required autofocus></textarea>
            </div>
          </div>
          <br />

          <br />
          <br />

          <div class="row justify-content-center">

            <button type="submit" class="btn btn-warning btn-block col col-2" name="task" value= "SendMessageController">Envoyer</button>

          </div>
        </div>

      </form>

    </div>
  </main>

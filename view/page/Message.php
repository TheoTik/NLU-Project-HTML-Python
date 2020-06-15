

<body class="bg-light">

<!-- New Email part ------->
    <main role="main" class="container bg-light px-5 py-5">


      <form class="input-topics justify-content-center" action="index.php" method="POST">
        	<h3><center>Envoyer un nouveau message</center></h3>
          <br />

      <div class="form-group">
        <div class="form-row justify-content-center">
          <div class="col col-8">
            <label for="inputUsername" class="font-weight-bold">Destinataire</label>

            <div class="input-group">
              <input type="text" class="form-control" name= "to"required autofocus >
            </div>
          </div>
        </div>
        <div class="form-row justify-content-center">
          <div class="col col-8">
            <label for="inputUsername" class="font-weight-bold">Sujet</label>

            <div class="input-group">
              <input type="text" class="form-control" name= "subject" aria-describedby="inputGroupPrepend2" required autofocus></input>
            </div>
          </div>
        </div>


        <div class="form-row justify-content-center">
          <div class="col col-8">

            <label for="textMessage" class="font-weight-bold">Message</label>
            <textarea rows="7" cols="40"type="text" class="form-control" name="textMessage" required autofocus></textarea>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <form action ="index.php">

          <button type="submit" name="task" class="btn btn-primary" value="SendMessageController" data-dismiss="modal">Envoyer</button>
        </form>
        <br/>
        <br/>

        </div>
  <!--End new email part---------->

      	<h3><center>Messages reçus</center></h3>
  <br/>
    </main>



</body>

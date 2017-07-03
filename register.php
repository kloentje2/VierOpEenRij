<?php
require "config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (trim($_POST['mail']) != NULL AND trim($_POST['password']) != NULL) {
		//Alles klopt (ingevuld)
		if ($user->createUser($_POST['mail'],$_POST['password']) == true) {
			Header("Location:login.php?from=register");
		}
	}
}
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registreren</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <form method="post" class="form-signin">
        <h2 class="form-signin-heading">Registreren</h2>
        <label for="inputUsername" class="sr-only">E-mailadres</label>
        <input type="email" name="mail" id="inputUsername" class="form-control" placeholder="E-mailadres" required autofocus>
        <label for="inputPassword" class="sr-only">Wachtwoord</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Wachtwoord" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registeren</button>
      </form>

    </div> <!-- /container -->
  </body>
</html>

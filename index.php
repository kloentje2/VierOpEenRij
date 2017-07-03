<?php
require "config.php";
if (@$_SESSION['loggedin'] != true) {
	Header("Location:login.php");
}
if( strlen( $user->getUserdata($_SESSION['uid'])->res['email'] ) > 10 ) {
   $email = substr( $user->getUserdata($_SESSION['uid'])->res['email'], 0, 10 ) . '...';
} else {
	$email = $user->getUserdata($_SESSION['uid'])->res['email'];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vier op een rij</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Vier op een rij</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li class=""><a href="#">Profiel (<?php echo $email; ?>)</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <div class="starter-template">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Vier op een rij - competitie</h3> 
			</div> 
			<div class="panel-body"> 
			<div class="col-sm-4">
				<strong>Meester in winnen (beste 5)</strong>
			</div>
			<div class="col-sm-4">
				<strong>Meester in gelijkspel (beste 5)</strong>
			</div>
			<div class="col-sm-4">
				<strong>Meester in verliezen (beste 5)</strong>
			</div>
		</div>
      </div>
	  
	  <div class="panel panel-warning">
			<div class="panel-heading">
				<h3 class="panel-title">Vier op een rij - uitdagingen</h3> 
			</div> 
			<div class="panel-body"> 
			<div class="col-sm-8">
				<table class="table">
					<tr>
						<th>#</th>
						<th>SpelerID 1</th>
						<th>SpelerID 2</th>
						<th>Creatiedatum</th>
						<th>Verloopdatum</th>
						<th>Actie</th>
					</tr>
					<?php
					$uitd = $con->query("SELECT * FROM game_sessions WHERE verlopen != 'true'");
					while ($row = $uitd->fetch_assoc()) {
						$date = strtotime($row['timestamp']);
						$date = strtotime("+7 day", $date);
						$date = date('d-m-o H:i:s',$date);
						
						$datee = strtotime($row['timestamp']);
						
						if( strlen( $user->getUserdata($row['userid1'])->res['email'] ) > 10 ) {
						   $email1 = substr( $user->getUserdata($row['userid1'])->res['email'], 0, 10 ) . '...';
						} else {
							$email1 = $user->getUserdata($row['userid1'])->res['email'];
						}
						
						if( strlen( $user->getUserdata($row['userid2'])->res['email'] ) > 10 ) {
						   $email2 = substr( $user->getUserdata($row['userid2'])->res['email'], 0, 10 ) . '...';
						} else {
							$email2 = $user->getUserdata($row['userid2'])->res['email'];
						}
						?>
							<tr>
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $email1; ?></td>
								<td><?php echo $email2; ?></td>
								<td><?php echo date('d-m-o H:i:s', $datee); ?></td>
								<td><?php echo $date; ?></td>
								<td><a class="btn btn-xs btn-success" href="loadgame.php?id=<?php echo $row['id']; ?>">Speel</a>&nbsp;<a class="btn btn-xs btn-danger" href="expiregame.php?id=<?php echo $row['id']; ?>">Verwerp</a></td>
							</tr>
						<?php
					}
					?>
				</table>
			</div>
			<div class="col-sm-4">
			<form method="POST" action="creategame.php">
			<datalist id="player">
				<?php
					$select = $con->query("SELECT email,id FROM users WHERE id != '".$con->real_escape_string($_SESSION['uid'])."'");
					while($row = $select->fetch_assoc()) {
				?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['email']; ?></option>
					<?php } ?>
			</datalist>
			<div class="col-sm-4">Speler:</div><div class="col-sm-4"> <input type="text" name="player" class="form-control" list="player" required></div>
			<input type="submit" class="btn btn-success" value="Nieuwe uitdaging">
			</div>
		</div>
      </div>
	  
	  <div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">Vier op een rij - verlopen uitdagingen</h3> 
			</div> 
			<div class="panel-body"> 
			<div class="col-sm-12">
				<table class="table">
					<tr>
						<th>#</th>
						<th>Speler 1</th>
						<th>Speler 2</th>
						<th>Creatiedatum</th>
						<th>Afloopdatum</th>
						<th>Winnaar</th>
					</tr>
					<?php
					$uitd = $con->query("SELECT * FROM game_sessions WHERE verlopen = 'true'");
					while ($row = $uitd->fetch_assoc()) {
						$date = strtotime($row['timestamp']);
						$date = strtotime("+7 day", $date);
						$date = date('d-m-o H:i:s',$date);
						
						$datee = strtotime($row['timestamp']);
						
						if( strlen( $user->getUserdata($row['userid1'])->res['email'] ) > 10 ) {
						   $email1 = substr( $user->getUserdata($row['userid1'])->res['email'], 0, 10 ) . '...';
						} else {
							$email1 = $user->getUserdata($row['userid1'])->res['email'];
						}
						
						if( strlen( $user->getUserdata($row['userid2'])->res['email'] ) > 10 ) {
						   $email2 = substr( $user->getUserdata($row['userid2'])->res['email'], 0, 10 ) . '...';
						} else {
							$email2 = $user->getUserdata($row['userid2'])->res['email'];
						}
						
						if( strlen( $user->getUserdata($row['winnaar_id'])->res['email'] ) > 10 ) {
						   $winnaar = substr( $user->getUserdata($row['winnaar_id'])->res['email'], 0, 10 ) . '...';
						} else {
							$winnaar = $user->getUserdata($row['winnaar_id'])->res['email'];
						}
					?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $email1; ?></td>
						<td><?php echo $email2; ?></td>
						<td></td>
						<td></td>
						<td><?php echo $winnaar; ?></td>
					</tr>
					<?php 
					}
					?>
				</table>
			</div>
		</div>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

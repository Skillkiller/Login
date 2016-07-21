<?php
session_start();
$verhalten = 0;

if(!isset($_SESSION["username"]) and !isset($_GET["page"])) {
    $verhalten = 0;
}
if(isset($_SESSION['username'])) {
    $verhalten = 3;    
}
if (isset($_GET["page"]) && ($_GET["page"]) == "log") {
    
    $user = strtolower($_POST["username"]);
    $password = md5($_POST["password"]);
    
    
    include(__DIR__ . "/config/Verbindungen.php");

    $control = 0;
    $abfrage = "SELECT * FROM user WHERE username = '$user' AND password = '$password'";
    $ergebnis = mysql_query($abfrage);
    while ($row = mysql_fetch_object($ergebnis))
        {
            $control++;
        }
    
    if ($control != 0) {
        $_SESSION["username"] = $user;
        $verhalten = 1;
    } else {
        $verhalten = 2;
    }
}
?>
<html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/css/custom_login.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <title>Zonen Dings</title>
    <?php
    if ($verhalten == 1 or $verhalten == 3) {
    ?>    
    
    <meta http-equiv="refresh" content="2; URL=user.php"  />
        
    <?php    
    }
    ?>
</head>
<body>

<div id="wrap">
<div class="container">
    <?php 
    if ($verhalten == 0) {
    ?>
    <form class="form-signin" method="post" action="index.php?page=log">
        <h2 class="form-signin-heading">Anmeldung</h2>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="Username">
		</div>	
		
		<div class="form-group">
        <label for="password">Passwort</label>
		<input type="password" name="password" class="form-control" id="password" placeholder="Password">
		</div>
       <input class="btn btn-lg btn-primary btn-block" type="submit" value="Anmelden" name="login1" />
	   
    </form>
	
	<br /><center><a href="register.php">Noch keinen Account?</a> </center>
    <?php 
    }
    if ($verhalten == 1) {
    ?>
	<div class="alert alert-success" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only">Anmeldung erfolgreich</span>
	Du hast dich angemeldet. Du wirst nun weitergeleitet...
	</div>

    <?php    
    }
    if ($verhalten == 2) {
    ?>
	
	<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Fehler</span>
  Dein Passwort oder Username ist falsch.
</div>
	<button type="button" class="btn btn-info"><a name="backlogin" href="index.php">Zurück</a></button>
	</div>
    <?php    
    }
    if ($verhalten == 3) {
    ?>
	<div class="alert alert-info" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only">Information</span>
    Du bist bereits angemeldet. Wir leiten dich weiter...
	</div>
    <?php
    }
    ?>
</div>



<div class="container">

  
  <h2>Du willst die aktuellsten News?</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Klicke hier</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Neuigkeiten vom 21.07.16</h4>
        </div>
        <div class="modal-body">
          <p class="lead">Durch den Sourcecode (bisher) können hier aktuelle Neuigkeiten eingetragen werden.</p>
			<p>Beachtet, dass auf <a href="https://github.com/Skillkiller/Login">GitHub</a>, die Neuigkeiten schneller aktualisiert werden.</p>
        </div>
		
		<div class="modal-header">
          <h4 class="modal-title">Neuigkeiten vom ??.??.??</h4>
        </div>
        <div class="modal-body">
          <p class="lead">Keine Informationen</p>
        </div>
		
		
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
        </div>
      </div>
      
    </div>
  </div>
 
</div>
    </div><!-- Wrap Div end -->
	
	
    <div id="footer">
      <div class="container">
        <p class="text-muted credit">Design by <a href="/user/hagakure">HAGAKURE</a>, Coding by <a href="/user/skillkiller">Skillkiller</a>. &copy; All rights reserverd 2016</p>
      </div>
    </div>
	

</body>
</html>
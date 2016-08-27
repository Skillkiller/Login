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
    
    $user = $_POST["username"];
    $password = md5($_POST["password"]);
    
    
    include(__DIR__ . "/config/Verbindungen.php");

    $control = 0;
	
    $abfrage = "SELECT * FROM user WHERE username = '$user' AND password = '$password'";
    $ergebnis = mysqli_query($verbindung, $abfrage);
	
    while ($row = mysqli_fetch_object($ergebnis))
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
<link rel="stylesheet" href="/css/custom_register.css">
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
<link href="css/fonts.css" rel="stylesheet" type="text/css" media="all" />

    <title>Startseite - Anmelden</title>
	
</head>
	
	
    <?php
    if ($verhalten == 1 or $verhalten == 3) {
    ?>    
    
    <meta http-equiv="refresh" content="0; URL=user"  />
        
    <?php    
    }
    ?>
<body>
<div id="wrap">
<div class="container">
    <?php 
    if ($verhalten == 0) {
    ?>		
	<div class="login">
  <div class="heading">
    <h2>Anmelden</h2>
    <form id="loginform" method="post" action="index.php?page=log">

      <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <input type="text" name="username" class="form-control" placeholder="Username">
          </div>

        <div class="input-group input-group-lg">
          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
          <input type="password" name="password" class="form-control" placeholder="Passwort">
        </div>

        <button type="submit" class="float">Login</button>
       </form>
	   
	   <div class="account">
	   <center><h3>Noch keinen Account?</h3>Dann jetzt schnell <a href="register">hier</a> kostenlos registrieren!</center>
	   </div>
 		</div>
 </div>
	
	<script>
	$("#loginform").validate();
	</script>
	
    <?php 
    }
    if ($verhalten == 1) {
    ?>
	<br><br>
	<div class="alert alert-success" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only">Anmeldung erfolgreich</span>
	Du hast dich angemeldet. Du wirst nun weitergeleitet...
	
	<?php
	$ip = $_SERVER["REMOTE_ADDR"];
	date_default_timezone_set('Europe/Berlin');
	
	$date = date('Y-m-d H:i:s');
	$sql = "UPDATE user SET lastlogin='$date' WHERE username='$user' AND password='$password'";
	$sql1 = "UPDATE user SET ip='$ip' WHERE username='$user' AND password='$password'";
	$sql2 = "UPDATE user SET status='1' WHERE username='$user' AND password='$password'";
	mysqli_query($verbindung, $sql);
	mysqli_query($verbindung, $sql1);
	mysqli_query($verbindung, $sql2);
	?>
	</div>

    <?php    
    }
    if ($verhalten == 2) {
    ?>
	<br><br>
	<div class="alert alert-danger" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Fehler</span>
		Die angegeben Daten sind falsch. Bitte überprüfe das Passwort, sowie den Username auf Richtigkeit.
	</div>
	
	<form action="index">
    <center><input class="btn btn-info" type="submit" value="Zurück" /></center>
	</form>
	</div><br><br>
    <?php    
    }
    if ($verhalten == 3) {
    ?>
	<meta http-equiv="refresh" content="0; URL=user"  />
    <?php
    }
    ?>
</div>
</div><!-- Wrap Div end -->
	
<?php
include('footer.php');
?>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>

</body>
</html>
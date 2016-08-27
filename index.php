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

<?php include('head.php'); ?>

    <title>Startseite - Anmelden</title>
	
	
    <?php
    if ($verhalten == 1 or $verhalten == 3) {
    ?>    
    
    <meta http-equiv="refresh" content="2; URL=user"  />
        
    <?php    
    }
    ?>
<body>
<div id="wrap">
<div class="container">
    <?php 
    if ($verhalten == 0) {
    ?>		
    <form class="form-signin" id="loginform" method="post" action="index?page=log">
    <h2 class="form-signin-heading">Anmeldung</h2>
		<div class="form-group">
			<label for="username">Username:</label>
			<input type="text" class="form-control" id="username" minlength="3" name="username" placeholder="Username" required>
		</div>	
		
		<div class="form-group">
        <label for="password">Passwort:</label>
		<input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
		</div>
       <input class="btn btn-lg btn-primary btn-block" type="submit" value="Anmelden" name="login1" /><br>
	   <center><div class="noacc"><a href="register">Noch keinen Account?</a></div> </center>
    </form>
	
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
	mysqli_query($verbindung, $sql);
	mysqli_query($verbindung, $sql1);
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
	
	<form action="/index.php">
    <input class="btn btn-info" type="submit" value="Zurück" />
	</form>
	</div>
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
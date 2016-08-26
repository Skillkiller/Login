<?php
error_reporting(0);
include('head.php');
?>
    <title>Neuer Account</title>

<body>
<div id="wrap">
<div class="container">
    <?php 
    if (!isset($_GET["page"])) {
    ?>
		
        <form class="form-signin" method="post" action="register?page=2">
			<h2 class="form-signin-heading">Registrierung</h2>
			
			<div class="form-group">
            <label for="username">Username</label>
			<input class="form-control" type="text" name="username" />
			</div>
			
			<div class="form-group">
            <label for="password1">Passwort</label>
			<input class="form-control" type="password" name="password1" />
			</div>
			
			<div class="form-group">
            <label for="password2">Passwort wiederholen</label>
			<input class="form-control" type="password" name="password2" />
			</div>
			<label>
			<input name="rules" type="checkbox"> Ich akzeptiere die <a href="rules">Richtlinen</a>
			</label>
			

            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Senden" />
        </form>
</div>
    </div><!-- Wrap Div end -->
    <div id="footer">
      <div class="container">
        <p class="text-muted credit">Design by <a href="/user/hagakure">HAGAKURE</a>, Coding by <a href="/user/skillkiller">Skillkiller</a>. &copy; All rights reserverd 2016</p>
      </div>
    </div>
</body>
</html>

  <?php 

    }
	include(__DIR__ . "/config/Verbindungen.php");
    if (isset($_GET['page']) && $_GET['page'] == "2") {
        $user = $_POST["username"];
        $pw = md5($_POST["password1"]);
        $pw2 = md5($_POST["password2"]);
        
		$fields = array('username', 'password1', 'password2', 'rules');

$error = false; 
foreach($fields AS $fieldname) { 
  if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
				echo '<br /><div class="container">
				<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<span class="sr-only">Fehler</span>
				Feld "'.$fieldname.'" ist frei.  Gehe <a href="register">zurück</a> und fülle die Felder sorgfältig aus.
				</div>
				</div> <br />'; 
				$error = true; 
  }
}


if(!$error) { 

				
			if($pw != $pw2) {
            echo '<br /><div class="container">
				  <div class="alert alert-danger" role="alert">
				  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				  <span class="sr-only">Fehler</span>
				  Deine Passwörter stimmen nicht überein. Gehe <a href="register">zurück</a>.
				  </div>
				  </div>';
        }else{

            		$control = 0;
            		$abfrage = "SELECT `username` FROM `user` WHERE `username` = '$user'";
            		$ergebnis = mysqli_query($verbindung, $abfrage);
            		while ($row = mysqli_fetch_object($ergebnis))
               		{
                   		$control++;
               		} 
			
			   
            if ($control != 0) {
                echo '<div class="container">
					  <div class="alert alert-warning" role="warning">
					   <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Fehler</span>
						Dieser Username ist schon vergeben. Gehe <a href="register">zurück</a>.
						</div>
						</div>';
            }else{
				
				$ip = $_SERVER["REMOTE_ADDR"];
				date_default_timezone_set('Europe/Berlin');
				$date = date('Y-m-d H:i:s');
				$eintrag = "INSERT INTO `user` (username, password, admin, ip, registerip, apikey, adminapikey, registerdate, lastlogin) VALUES ('$user', '$pw', 0, '$ip', '$ip', 0, 0, '$date', '0000-00-00 00:00:00')";
                $eintragen = mysqli_query($verbindung, $eintrag);

                if ($eintragen == true) {
                    echo '<div class="container">
						<div class="alert alert-success" role="success">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Erfolgreich!</span>
						Du hast dich erfolgreich registriert. <a href="index">Starte jetzt sofort</a>!
						</div>
						</div> ';
                } else {
                    echo '<div class="container">
						<div class="alert alert-danger" role="danger">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Fehler</span>
						Es ist ein Fehler aufgetreten. Um das Problem zu lösen, schreibe bitte Skillkiller mit der Message an:
						<br><br>
						---------- REGISTER ERROR ------------
						<br>
						---------------------------------------------------
						</div>
						</div>';
                }
                mysqli_close($verbindung);    
            }   
        }
	}
}
    ?>
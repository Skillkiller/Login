<?php
error_reporting(0);
include('headlogin.php');
?>
    <title>Neuer Account</title>

<body>
    <?php 
    if (!isset($_GET["page"])) {
    ?>
		
 <div class="login">
  <div class="heading">
    <h2>Registrierung</h2>
    <form method="post" action="register?page=2">
	

      <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <input type="text" name="username" class="form-control" placeholder="Username">
          </div>
		  
		  <div class="input-group input-group-lg">
          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
          <input type="email" name="email" class="form-control" placeholder="E-Mail">
        </div>

        <div class="input-group input-group-lg">
          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
          <input type="password" name="password1" class="form-control" placeholder="Passwort">
        </div>
		
		<div class="input-group input-group-lg">
          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
          <input type="password" name="password2" class="form-control" placeholder="Passwort wiederholung">
        </div>
		
		<br>
		
		<div class="account">
		Mit dem Absenden des Formulars bestätigst du, dass du die <a href="rules">Richtlinien </a> gelesen und akzeptiert hast.
		</div>
		
        <button type="submit" class="float">Login</button>
       </form>

 		</div>
 </div>
        </form>
	
    <?php include('footer.php');?>
</body>
</html>

  <?php 

    }
	include(__DIR__ . "/config/Verbindungen.php");
    if (isset($_GET['page']) && $_GET['page'] == "2") {
        $user = $_POST["username"];
        $pw = md5($_POST["password1"]);
        $pw2 = md5($_POST["password2"]);
		$email = $_POST["email"];
        
		$fields = array('username', 'password1', 'password2');

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

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    exit('<br /><div class="container">
				  <div class="alert alert-danger" role="alert">
				  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				  <span class="sr-only">Fehler</span>
				  Ungültige E-Mail. Gehe <a href="register">zurück</a>.
				  </div>
				  </div>');
$select = mysqli_query($verbindung, "SELECT `email` FROM `user` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error());
if(mysqli_num_rows($select))
    exit('<br /><div class="container">
				  <div class="alert alert-danger" role="alert">
				  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				  <span class="sr-only">Fehler</span>
				  Diese E-Mail existiert bereits. Gehe <a href="register">zurück</a>.
				  </div>
				  </div>');

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
				
				include(__DIR__ . "/functions/api.php");
				
				$wait = true;
				$versuch = 1;
		
				while (($wait) && ($versuch < 5)) {
					$key = randomstring(16);
			
					if (isapifree($key)) {
						$wait = false;
					}
			
					$versuch++;
			
				}
				
				
				if ($wait) {
					user_error("Nach Versuch $versuch wurde kein freier String gefunden", E_USER_ERROR);
				}
				
				$eintrag = "INSERT INTO `user` (username, email, password, admin, ip, registerip, apikey, adminapikey, registerdate, lastlogin) VALUES ('$user', '$email', '$pw', 0, '$ip', '$ip', '$key', 0, '$date', '0000-00-00 00:00:00')";
                $eintragen = mysqli_query($verbindung, $eintrag);

                if ($eintragen == true) {
                    echo '
						<div class="container">
						<div class="alert alert-success" role="success">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Erfolgreich!</span>
						Du hast dich erfolgreich registriert. Damit du Zugriff auf das Control Panel hast, melde dich bitte an.
					
						</div>
						</div>
						<br><br>
						<form action="index">
						<center><input class="btn btn-info" type="submit" value="Zurück" /></center>
						</form>

						';
                } else {
                    echo '<div class="container">
						<div class="alert alert-danger" role="danger">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Fehler</span>
						Es ist ein Fehler aufgetreten. Um das Problem zu lösen, schreibe bitte Skillkiller mit der Message an:
						<br><br>
						---------- REGISTER ERROR ------------
						<br>' . mysqli_error($verbindung) . '<br>
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
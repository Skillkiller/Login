<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/custom_login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <title>Neuer Account</title>
</head>
<body>
<div id="wrap">
<div class="container">
    <?php 
    if (!isset($_GET["page"])) {
    ?>
		
        <form class="form-signin" method="post" action="register.php?page=2">
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
			<input type="checkbox"> Ich akzeptiere die <a href="rules.php">Richtlinen</a>
			</label>
			

            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Senden" />
        </form>
    <?php 
    }
    if (isset($_GET['page']) && $_GET['page'] == "2") {
        $user = strtolower($_POST["username"]);
        $pw = md5($_POST["password1"]);
        $pw2 = md5($_POST["password2"]);
        
        if (!empty($pw) or !empty($user)) {
        	if ($pw != $pw2) {
            		echo "Deine Passw&ouml;rter stimmen nicht &uuml;berein....<a href=\"register.php\">zur&uuml;ck</a>";
        	} else {
            		include(__DIR__ . "/config/Verbindungen.php"); 
            		$control = 0;
            		$abfrage = "SELECT username FROM user WHERE user = '$user'";
            		$ergebnis = mysql_query($abfrage);
            		while ($row = mysql_fetch_object($ergebnis))
               		{
                   		$control++;
               		} 
            		if ($control != 0) {
                		echo "Dieser Name ist schon vergeben. <a href=\"register.php\">zur&uuml;ck</a>";
            		} else {
                		$eintrag = "INSERT INTO user
                		(username,password)
                
                		VALUES
                		('$user', '$pw')";
                
                		$eintragen = mysql_query($eintrag);
                		if ($eintragen == true) {
                    			echo "Regestrierung abgeschlossen.  <a href=\"index.php\">Jetzt anmelden</a>";
                		} else {
                    			echo "Fehler im System.";
                		}
                		mysql_close($verbindung);    
            		}   
        	}	
        	
        } else {
        	echo "Du darfst kein Feld leer lassen! <a href=\"register.php\">zur&uuml;ck</a>"	
        }
    }
    ?>
</div>

    </div><!-- Wrap Div end -->

    <div id="footer">
      <div class="container">
        <p class="text-muted credit">Design by <a href="/user/hagakure">HAGAKURE</a>, Coding by <a href="/user/skillkiller">Skillkiller</a>. &copy; All rights reserverd 2016</p>
      </div>
    </div>
</body>
</html>

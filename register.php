<?php
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
            		$abfrage = "SELECT username FROM user WHERE username = '$user'";
            		$ergebnis = mysqli_query($verbindung, $abfrage);
	
					while ($row = mysqli_fetch_object($ergebnis))
					{
					$control++;
					}

            		if ($control != 0) {
                		echo "Dieser Name ist schon vergeben. <a href=\"register.php\">zur&uuml;ck</a>";
            		} else {
                		$eintrag = "INSERT INTO user (username,password) VALUES ('$user', '$pw')";
                
                		$eintragen = mysqli_query($verbindung, $eintrag);
                		if ($eintragen == true) {
                    			echo "Regestrierung abgeschlossen.  <a href=\"index.php\">Jetzt anmelden</a>";
                		} else {
                    			echo "Fehler im System.";
                		}
                		mysqli_close($verbindung);    
            		}   
        	}	
        	
        } else {
        	echo "Du darfst kein Feld leer lassen! <a href=\"register.php\">zur&uuml;ck</a>";

    }}6
    ?>
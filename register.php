<html>
<header>
    <title>Neuer Account</title>
</header>
<body>
    <h3>Registrieren</h3>
    <?php 
    if (!isset($_GET["page"])) {
    ?>
        <form method="post" action="register.php?page=2">
            <p>Username:</p><input type="text" name="username" /><br />
            <p>Password:</p><input type="password" name="password1" /><br />
            <p>Password wiederholen:</p><input type="password" name="password2" /><br />
            <input type="submit" value="Senden" />
        </form>
    <?php 
    }
    if (isset($_GET['page']) && $_GET['page'] == "2") {
        $user = strtolower($_POST["username"]);
        $pw = md5($_POST["password1"]);
        $pw2 = md5($_POST["password2"]);
        
        if ($pw != $pw2) {
            echo "Deine Passw&ouml;rter stimmen nicht &uuml;berein....<a href=\"register.php\">zur&uuml;ck</a>";
        } else {
            include(__DIR__ . "/config/Verbindung.php");
                        
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
    }
    ?>

</body>
</html>
<?php
session_start();
$verhalten = 0;

if(!isset($_SESSION["username"]) and !isset($_GET["page"])) {
    $verhalten = 1;
}
if(isset($_SESSION['username'])) {
    $verhalten = 3;    
}
if (isset($_GET["page"]) && ($_GET["page"]) == "log") {
    
    $user = strtolower($_POST["username"]);
    $password = md5($_POST["password"]);
    
    
    include(__DIR__ . "/config/Verbindung.php");

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
    <title>Zonen Dings</title>
    <?php
    if ($verhalten == 1 or $verhalten == 3) {
    ?>    
    
    <meta http-equiv="refresh" content="3; URL=user.php"  />
        
    <?php    
    }
    ?>
</head>
<body>
    <?php 
    if ($verhalten == 0) {
    ?>
    <p>Bitte melde dich an:</p>    
    <form method="post" action="index.php?page=log">
        <p>Username:</p><input type="text" name="username" /><br />
        <p>Password:</p><input type="password" name="password" /><br />
        <input type="submit" value="Anmelden" />
    </form>
	<a href="register.php">Noch keinen Account ?</a>
    <?php 
    }
    if ($verhalten == 1) {
    ?>
    <h2>Du hast dich angemeldet. Du wirst nun weitergeleitet...</h2>
    <?php    
    }
    if ($verhalten == 2) {
    ?>
    <p>Nutzer oder Passwort falsch. <a href="index.php">Zur&uuml;ck</a></p>
    <?php    
    }
    if ($verhalten == 3) {
    ?>
    <h2>Du warst bereits angemelddet. Wir leiten dich weiter...</h2>
    <?php
    }
    ?>



</body>
</html>
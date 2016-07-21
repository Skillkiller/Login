<?php
session_start();
if (isset($_SESSION["username"])) {
?>
<html>
<head>
    <title>Backend</title>
</head>
<body>
    <h1>Hallo <?php echo $_SESSION["username"] ?></h1>
    <a href="logout.php">Abmelden</a>

</body>
</html>
<?php    
} else {
?> 
<p>Um diesen Bereich betreten zu d&uuml;rfen musst du dich erst anmelden. <a href="index.php">Zur&uuml;ck</a></p>  
<?php    
}
?>
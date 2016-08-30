<?php
$datenbank = "Login";
$verbindung = mysqli_connect("localhost", "root", "samp")
or die ("Fehler bei der Anmeldung");

mysqli_select_db($verbindung, $datenbank)
or die ("Verbindung zur Datenbank gescheitert");
?>

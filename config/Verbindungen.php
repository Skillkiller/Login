<?php
$verbindung = mysql_connect("localhost", "user", "password")
or die ("Fehler bei der Anmeldung");

mysql_select_db("datenbank")
or die ("Verbindung zur Datenbank gescheitert");
?>

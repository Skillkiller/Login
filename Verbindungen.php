<?php
$verbindung = mysql_connect("localhost", "user", "pass")
or die ("Fehler bei der Anmeldung");

mysql_select_db("db")
or die ("Verbindung zur Datenbank gescheitert");
?>

<?php

function randomstring($length = 16) {
  // $chars - String aller erlaubten Zahlen
  $chars = "abcdefghijklmnopqrstuvwxyz
            ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
  // Funktionsstart
  srand((double)microtime()*1000000);
  $i = 0; // Counter auf null
  while ($i < $length) { // Schleife solange $i kleiner $length
    // Holen eines zufälligen Zeichens
    $num = rand() % strlen($chars);
    // Ausf&uuml;hren von substr zum wählen eines Zeichens
    $tmp = substr($chars, $num, 1);
    // Anhängen des Zeichens
    $pass = $pass . $tmp;
    // $i++ um den Counter um eins zu erhöhen
    $i++;
  }
  // Schleife wird beendet und 
  // $pass (Zufallsstring) zurück gegeben
  return $pass;
}


function getapi($username) {
	$query = "SELECT `username`,`apikey` FROM `user` WHERE `username` = '$username'";
	$execute = mysqli_query($verbindung, $query) or die("Error: ".mysqli_error($verbindung));

	$row = $execute->fetch_array(MYSQL_BOTH);
	
	return $row["apikey"];
}

function hasapi($username) {
	$query = "SELECT `username`,`apikey` FROM `user` WHERE `username` = '$username'";
	$execute = mysqli_query($verbindung, $query) or die("Error: ".mysqli_error($verbindung));

	$row = $execute->fetch_array(MYSQL_BOTH);
	if ($row["apikey"] != "0") {
		return true;
	} else {
		return false;
	}
}

function setapi($username) {
	if hasapi($username) {
		return getapi($username);
	} else {
		$pass = randomstring(16);
		$query = "UPDATE `$datenbank`.`user` SET `apikey` = '$pass' WHERE `user`.`username` = '$username'";
		$execute = mysqli_query($verbindung, $query) or die("Error: ".mysqli_error($verbindung));
		
		$row = $execute->fetch_array(MYSQL_BOTH);
		return getapi($username);
	}
}













?>
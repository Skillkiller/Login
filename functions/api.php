<?php
function randomstring($length = 16) {
	include(__DIR__ . "/../config/Verbindungen.php");
  // $chars - String aller erlaubten Zahlen
  $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
  // Funktionsstart
  srand((double)microtime()*1000000);
  $i = 0; // Counter auf null
  while ($i < $length) { // Schleife solange $i kleiner $length
    // Holen eines zuf?lligen Zeichens
    $num = rand() % strlen($chars);
    // Ausf&uuml;hren von substr zum w?hlen eines Zeichens
    $tmp = substr($chars, $num, 1);
    // Anh?ngen des Zeichens
    $pass = $pass . $tmp;
    // $i++ um den Counter um eins zu erh?hen
    $i++;
  }
  // Schleife wird beendet und
  // $pass (Zufallsstring) zur?ck gegeben
  return $pass;
}
 
 
function getapi($username) {
	include(__DIR__ . "/../config/Verbindungen.php");
    $query = "SELECT `username`,`apikey` FROM `user` WHERE `username` = '$username'";
    $execute = mysqli_query($verbindung, $query) or die("Error: ".mysqli_error($verbindung));
 
    $row = $execute->fetch_array(MYSQL_BOTH);
   
    return $row["apikey"];
}
 
function hasapi($username) {
	include(__DIR__ . "/../config/Verbindungen.php");
    $query = "SELECT `username`,`apikey` FROM `user` WHERE `username` = '$username'";
    $execute = mysqli_query($verbindung, $query) or die("Error: ".mysqli_error($verbindung));
 
    $row = $execute->fetch_array(MYSQL_BOTH);
    if ($row["apikey"] != "0") {
        return true;
    } else {
        return false;
    }
}
 
function isapifree($key) {
	include(__DIR__ . "/../config/Verbindungen.php");
    $control = 0;
    $query = "SELECT `username`,`apikey` FROM `user` WHERE `apikey` = '$key'";
    $ergebnis = mysqli_query($verbindung, $abfrage);
   
    while ($row = mysqli_fetch_object($ergebnis))
    {
        $control++;
    }
   
    if ($control != 0) {
        return false;
    } else {
        return true;
    }
}
 
function setapi($username) {
	include(__DIR__ . "/../config/Verbindungen.php");
    if (hasapi($username)) {
        return getapi($username);
    } else {
        $wait = true;
        $versuch = 1;
       
        while (($wait) && ($versuch < 5)) {
            $key = randomstring(16);
           
            if (isapifree($key)) {
                $wait = false;
            }
           
            $versuch++;
           
        }
       
        if ($wait == false) {
            $query = "UPDATE `$datenbank`.`user` SET `apikey` = '$key' WHERE `user`.`username` = '$username'";
            $execute = mysqli_query($verbindung, $query) or die("Error: ".mysqli_error($verbindung));
           
            $row = $execute->fetch_array(MYSQL_BOTH);
            return getapi($username);
        } else {
            user_error("Nach Versuch $versuch wurde kein freier String gefunden", E_USER_ERROR);
        }
    }
}
 
?>
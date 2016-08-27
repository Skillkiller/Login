<?php
session_start();
include(__DIR__ . "/config/Verbindungen.php");
	$user = $_SESSION['username'];
	$sql = "UPDATE user SET status='0' WHERE username='$user'";
	mysqli_query($verbindung, $sql);
	
session_destroy();

include('headlogin.php');
?>
    <title>Abgemldet</title>
    <meta http-equiv="refresh" content="1; URL=index"  />
<body>
<br><br>
<div class="container">
<div class="alert alert-success" role="success">
<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
<span class="sr-only">Erfolgreich</span>
Du wurdest erfolgreich abgemeldet.
</div>
<br><br><br><br>
<?php
include('footer.php');
?>
</div>
</body>
</html>
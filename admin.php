<?php
session_start();
if (isset($_SESSION["username"])) {
    //User ist auf jedenfall schon mal angemeldet
    $username = $_SESSION["username"];
	
    include(__DIR__ . "/config/Verbindungen.php");
    $abfrage = "SELECT admin FROM `user`";
    $ergebnis = mysqli_query($verbindung, $abfrage);
	
	
		foreach ($ergebnis as $row) {
        if ($row["admin"] > 0) {
		$admin = $row["admin"];
		include('head.php');	
?>
<title>Startseite</title>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Projektname</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Administration</a></li>
            <li><a href="user">Startseite</a></li>
            <li><a href="#profile">Profil</a></li>
            <li><a href="#help">Hilfe</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Suche..">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Startseite <span class="sr-only">(current)</span></a></li>
            <li><a href="queryuser">User Abfrage</a></li>
            <li><a href="tabuser">User Tabelle</a></li>
            <li><a href="admin">Administration</a></li>
          </ul>
          <!-- <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>-->
          <ul class="nav nav-sidebar">
            <li><a href="stats">Statistiken</a></li>
            <li><a href="logout">Abmelden</a></li>
          </ul>
		  
		  <br><br>
		  <?php
			include('footer.php');
			?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Willkommen, <?php echo $_SESSION["username"]; ?>!</h1>

Du bist Admin Rang <b><?php echo $row["admin"]; ?></b>


	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="http://getbootstrap.com/assets/js/vendor/holder.min.js"></script>

	
</body>
</html>

		<?php
		}else{
		?>
		<?php include('head.php'); ?>
<body>
<div class="container">
<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Fehler</span>
  Um diesen Bereich betreten zu d&uuml;rfen, musst du dich dem <b>Server Team</b> bewerben.

</div>
	<form action="/user.php">
    <input class="btn btn-info" type="submit" value="Zurück" />
	</form>
</div>

</body>
</html>
<?php
		}}}
		?>
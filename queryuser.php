<?php
session_start();
	if (isset($_SESSION["username"])) {
    //User ist auf jedenfall schon mal angemeldet
    $username = $_SESSION["username"];
	// $admin = $_SESSION["admin"];
 
    include(__DIR__ . "/config/Verbindungen.php");
    $abfrage = "SELECT admin FROM `user`";
    $ergebnis = mysqli_query($verbindung, $abfrage);
	

 foreach ($ergebnis as $row) {
        if ($row["admin"] == 0) {
	
include('head.php');
?>
<body>
<div class="container">
<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Fehler</span>
  Um diesen Bereich betreten zu d&uuml;rfen, musst du dich dem <b>Server Team bewerben</b>.<br />  Gehe <a href="user">zurück</a>.
</div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="http://getbootstrap.com/assets/js/vendor/holder.min.js"></script>
</body>
</html>
<?php
}else{
include('head.php');
?>

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
            <li><a href="#">Startseite <span class="sr-only">(current)</span></a></li>
            <li class="active"><a href="queryuser">User Abfrage</a></li>
            <li><a href="tabuser">User Tabelle</a></li>
            <li><a href="admin">Administration</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">Statistiken</a></li>
            <li><a href="logout">Abmelden</a></li>
          </ul>
		  
		  <br><br>
		  <?php
			include('footer.php');
			?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">User Abfrage</h1>
		  <form class="form-signin" id="searchform" method="post" action="queryuser?page=search">
		<label class="sr-only" value="Spieler suchen..." for="inputHelpBlock">User suchen</label>
<div class="form-group">
            <label for="username">Username</label>
			<input class="form-control" type="text" name="username" />
			</div>
<span id="helpBlock" class="help-block">Tippe hier den Usernamen ein, um eine Suche durchzuführen. Klicke dann auf "Suchen".</span>
		  <input class="btn btn-lg btn-primary btn-block" type="submit" value="Suchen" name="submit" />
		  </form>
<?php
if(isset($_POST['submit'])){
	$user = $_POST['username'];
		$abfrage = "SELECT * FROM user";
    $ergebnis = mysqli_query($verbindung, $abfrage);
	
	
 while($row = mysqli_fetch_row($ergebnis)){
         echo $row[0].' - '.$row[1].'<br />';
}}
?>

<table class="table table-striped">
<?php
while($row = mysqli_fetch_row($ergebnis)){
echo '"<td>"<?php $row[0]; ?>"</td><td>"<?php $row[1]; ?>"</td><td>"<?php $row[2]; ?>"</td><td>"<?php $row[3]; ?>"</td>"';
}
?>
</table>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="http://getbootstrap.com/assets/js/vendor/holder.min.js"></script>

	
<?php
 }}}
?>
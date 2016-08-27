<?php
session_start();
include(__DIR__ . "/config/Verbindungen.php");

$query = "SELECT admin FROM user";
$execute = mysqli_query($verbindung, $query);

foreach ($execute as $row) {
        if ($row["admin"] > 0) {
			if (isset($_SESSION["username"])) {
				$admin = $row["admin"];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Control Panel</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/style.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-yellow.min.css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries 
   WARNING: Respond.js doesn't work if you view the page via file:// 
  [if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif] -->
</head>



<!-- SKINS UND LAYOUT
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav  (Bugged)                |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-yellow layout-boxed">
<div class="wrapper">
  <header class="main-header">

    <a href="index2.html" class="logo">
      <span class="logo-mini"><b>Admin</b>CP</span>
      <span class="logo-lg"><b>Admin</b>CP</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?php echo $_SESSION['username']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="dist/img/avatar.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['username'];?>
                  <small>Letzter Login: </small>
				  <small>Mitglied seit: </small>
                </p>
              </li>

              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/<?php echo $_SESSION['username'];?>" class="btn btn-default btn-flat">Mein Profil</a>
                </div>
                <div class="pull-right">
                  <a href="logout" class="btn btn-default btn-flat">Abmelden</a>
                </div>
              </li>
            </ul>
          </li> 
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar.png" class="img-circle" alt="Kein Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['username']; ?></p>

        </div>
      </div> 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Suche... (deaktiviert)" disabled>
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
	  
	  
      <ul class="sidebar-menu">
        <li class="header">Menü</li>
        <li><a href="admin"><i class="fa fa-link"></i> <span>Startseite</span></a></li>
		<li class="active"><a href="admnews"><i class="fa fa-link"></i> <span>News</span></a></li>
		<li><a href="adminapi"><i class="fa fa-link"></i> <span>Admin API</span></a></li>
		<li><a href="usersearch"><i class="fa fa-link"></i> <span>Usersuche</span></a></li>
		<li><a href="accountedit"><i class="fa fa-link"></i> <span>Accountbearbeitung</span></a></li>
		<li><a href="adminsettings"><i class="fa fa-link"></i> <span>Admin Einstellungen</span></a></li>
        
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Admin News
        <small>Alle administrativen Neuigkeiten von der Projektleitung</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Startseite</a></li>
        <li>ACP</li>
		<li class="active">Admin News</li>
      </ol>
    </section>

 
<section class="content">

</section>
</div>
 <?php
	
 ?>
  
  
  
  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Danke an HAGAKURE für das Design. Skillkiller als Programmierer.
    </div>
    <strong>Copyright &copy; 2016 <a href="#">Control Panel</a>.</strong> Alle Rechte vorbehalten.
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="dist/js/app.min.js"></script>
</body>
</html>
<?php  
}
}
}
?>

<?php
session_start();
include(__DIR__ . "/config/Verbindungen.php");
if (isset($_SESSION["username"])) {

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Control Panel</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/bootstrap.min.css">
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
      <span class="logo-mini"><b>User</b>CP</span>
      <span class="logo-lg"><b>User</b>CP</span>
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
        <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Startseite</span></a></li>
		<li><a href="news"><i class="fa fa-link"></i> <span>News</span></a></li>
		<li><a href="settings"><i class="fa fa-link"></i> <span>Einstellungen</span></a></li>
        <?php ?>
		<li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Administration</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="admin">ACP</a></li>
            <li><a href="admnews">News</a></li>
            <li><a href="adminapi">Admin API</a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Startseite
        <small>Deine Account Informationen</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Startseite</a></li>
        <li class="active">Hier</li>
      </ol>
    </section>

 
    <section class="content">
       Hier kannst du bald deine Informationen abrufen können.
    </section>
  </div>
  
  
  
  
  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Danke an HAGAKURE für das Design. Skillkiller als Programmierer.
    </div>
    <strong>Copyright &copy; 2016 <a href="#">Control Panel</a>.</strong> Alle Rechte vorbehalten.
  </footer>

  

</div>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="dist/js/app.min.js"></script>
</body>
</html>


<?php    
} else {
	
include('head.php');
?> 

<body>
<div class="container">
<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Fehler</span>
  Um diesen Bereich betreten zu d&uuml;rfen musst du dich erst anmelden. Gehe <a href="index">zurück</a>.
</div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="http://getbootstrap.com/assets/js/vendor/holder.min.js"></script>
</body>
</html>
<?php
}
?>
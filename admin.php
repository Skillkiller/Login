<?php


// ----------------------------------------------------------------------------------------------------
// - Display Errors
// ----------------------------------------------------------------------------------------------------
ini_set('display_errors', 'On');
ini_set('html_errors', 0);

// ----------------------------------------------------------------------------------------------------
// - Error Reporting
// ----------------------------------------------------------------------------------------------------
error_reporting(-1);

// ----------------------------------------------------------------------------------------------------
// - Shutdown Handler
// ----------------------------------------------------------------------------------------------------
function ShutdownHandler()
{
    if(@is_array($error = @error_get_last()))
    {
        return(@call_user_func_array('ErrorHandler', $error));
    };

    return(TRUE);
};

register_shutdown_function('ShutdownHandler');

// ----------------------------------------------------------------------------------------------------
// - Error Handler
// ----------------------------------------------------------------------------------------------------
function ErrorHandler($type, $message, $file, $line)
{
    $_ERRORS = Array(
        0x0001 => 'E_ERROR',
        0x0002 => 'E_WARNING',
        0x0004 => 'E_PARSE',
        0x0008 => 'E_NOTICE',
        0x0010 => 'E_CORE_ERROR',
        0x0020 => 'E_CORE_WARNING',
        0x0040 => 'E_COMPILE_ERROR',
        0x0080 => 'E_COMPILE_WARNING',
        0x0100 => 'E_USER_ERROR',
        0x0200 => 'E_USER_WARNING',
        0x0400 => 'E_USER_NOTICE',
        0x0800 => 'E_STRICT',
        0x1000 => 'E_RECOVERABLE_ERROR',
        0x2000 => 'E_DEPRECATED',
        0x4000 => 'E_USER_DEPRECATED'
    );

    if(!@is_string($name = @array_search($type, @array_flip($_ERRORS))))
    {
        $name = 'E_UNKNOWN';
    };

    return(print(@sprintf("%s Error in file \xBB%s\xAB at line %d: %s\n", $name, @basename($file), $line, $message)));
};

$old_error_handler = set_error_handler("ErrorHandler");

// other php code



session_start();
include(__DIR__ . "/config/Verbindungen.php");

$username = $_SESSION['username'];
$query = "SELECT `admin`,`username` FROM `user` WHERE `username` = '$username'";
$execute = mysqli_query($verbindung, $query) or die("Error: ".mysqli_error($verbindung));

$row = $execute->fetch_array(MYSQL_BOTH);

if ($row["admin"] > 0 and $row["username"] == $username) {
	
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Control Panel</title>
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
				  <?php 
	$username = $_SESSION['username'];
	$query = "SELECT * FROM `user` WHERE username = '$username'";
	$execute2 = mysqli_query($verbindung, $query) 
	or die("Error: ".mysqli_error($verbindung));
	
	if ($execute2->num_rows > 0) {
    // output data of each row
    while($row = $execute2->fetch_assoc()) { ?>
                  <small>Letzter Login: <?php echo $row["lastlogin"]; ?></small>
				  <small>Mitglied seit: <?php echo $row["registerdate"]; ?></small>
	<?php }}?>
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
        <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Startseite</span></a></li>
		<li><a href="admnews"><i class="fa fa-link"></i> <span>News</span></a></li>
		<li><a href="adminapi"><i class="fa fa-link"></i> <span>Admin API</span></a></li>
		<li><a href="usersearch"><i class="fa fa-link"></i> <span>Usersuche</span></a></li>
		<li><a href="accountedit"><i class="fa fa-link"></i> <span>Accountbearbeitung</span></a></li>
		<li><a href="adminsettings"><i class="fa fa-link"></i> <span>Admin Einstellungen</span></a></li>
        
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
        <li class="active">ACP</li>
      </ol>
    </section>

 
<section class="content">
<div class="alert alert-info">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<b>WICHTIGE INFORMATION:</b>
<p>Anbei erhälst du alle Informationen über deinen <b>administrativen Account</b>. Bitte bewahre deine Daten gut. Im Falle einer Weitergabe verliest laut den Richtlinien deinen Status "Administrator". Der Verlust ist unersetzbar und kann nicht wiederhergestellt werden.</p>
</div>	

<div class="alert alert-info">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<b>Information:</b>
<p>Die Zahl unter Status haben folgende Eigenschaften.</p>
<p> 1 = User ist online </p>
<p> 0 = User ist offline </p>
Der Spieler hat jedoch keinen Zugriff auf das ACP.
</div>	
	<table class="table table-condensed">
	
	<?php 
	$query = "SELECT * FROM `user` WHERE `username` = '$username'"; 
	$execute2 = mysqli_query($verbindung, $query) 
	or die("Error: ".mysqli_error($verbindung));
	
	$row = $execute2->fetch_array(MYSQL_BOTH);
	
        
	?>
<tr>
  <td><b>ID:</b></td>
  <td><?php echo $row['id']; ?></td>
  <td><b>Name:</b></td>
  <td><?php echo $_SESSION["username"]; ?></td>
  <td><b>E-Mail:</b></td>
  <td><?php echo $row["email"]; ?></td>
  <td><b>Admin:</b><td>
  <td><?php echo $row["admin"]; ?></td>
  <td><b>Letzte Aktivität:</b></td>
  <td><?php echo $row["lastlogin"]; ?></td>
<br>
</tr>

<tr>
<td><b>API Key:</b></td>
<td><?php echo $row["apikey"]; ?></td>
<td><b>Admin API Key:</b></td>
<td><?php echo $row["adminapikey"]; ?></td>
<td><b>Register IP:</b></td>
<td><?php echo $row["registerip"]; ?></td>
<td><b>IP:</b></td>
<td><?php echo $row["ip"]; ?></td>
<td><b>Registierung:</b></td>
<td><?php echo $row["registerdate"]; ?></td>
<td><b>Status:</b></td>
<td><?php echo $row["status"]; ?></td>
</tr>
      
	</table>
</section>
</div>

  
  
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
 
} else {
    echo "Du bist leider nicht Berechtigt";
	/*
	Bitte vervollständigen!
	*/
}

?>

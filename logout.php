<?php
session_start();
session_destroy();

include('head.php');
?>
    <title>Abgemldet</title>
    <meta http-equiv="refresh" content="2; URL=index"  />
<body>
<br><br>
<div class="container">
<div class="alert alert-success" role="success">
<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
<span class="sr-only">Fehler</span>
Du wurdest erfolgreich abgemeldet.
</div>
<br><br><br><br>
<?php
include('footer.php');
?>
</div>
</body>
</html>
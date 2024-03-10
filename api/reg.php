<?php include_once "db.php";
unset($_POST['pw2']);
// dd($_POST);
$res=$User->save($_POST);

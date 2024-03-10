<?php include_once "db.php";

$res=$User->count($_POST);
// echo $res;
if($res){
    $_SESSION['user']=$_POST['acc'];
}

echo $res;
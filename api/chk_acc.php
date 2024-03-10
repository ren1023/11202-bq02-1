<?php include_once "db.php";

$res=$User->count($_POST);

if($res>0){
    echo 1;
}else{
    echo 0;
}
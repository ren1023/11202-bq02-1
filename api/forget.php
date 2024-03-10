<?php include_once "db.php";

// dd($_GET);

$res=$User->find($_GET);
if(empty($res)){
    echo "查無此資料";
}else{
    echo "您的密碼為：".$res['pw'];
}


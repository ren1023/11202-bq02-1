<?php include_once "db.php";
// dd($_POST);
if(isset($_POST['subject'])){
    $Que->save(['que'=>$_POST['subject'],'big_id'=>0,'vote'=>0]);
}

$big=$Que->find(['que'=>$_POST['subject']]);

if(isset($_POST['option']) && !empty($_POST['option'])){
    foreach($_POST['option'] as $que){
        $Que->save(['que'=>$que,'big_id'=>$big['id'],'vote'=>0]);
    }
}

to("../back.php?do=que");
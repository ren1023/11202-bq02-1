<?php include_once "db.php";
$opt=$Que->find($_POST['ques']);
$opt['vote']++;
$Que->save($opt);

$sub=$Que->find($opt['big_id']);
$sub['vote']++;
$Que->save($sub);

to("../index.php?do=result&id={$sub['id']}");
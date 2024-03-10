<?php
$que=$Que->find(['id'=>$_GET['id']]);
?>
<fieldset>
    <legend>目前位置:首頁>問卷調查><span><?=$que['que'];?></span></legend>
     <h3><?=$que['que'];?></h3>
     <form action="./api/vote.php" method="post">
    <table>       
        
        <?php
        $rows=$Que->all(['big_id'=>$_GET['id']]);
        // dd($rows);
        // exit();
        foreach($rows as $row){
        ?>
        <tr>
        <td>
            <input type="radio" name="ques" value="<?=$row['id'];?>">
            <?=$row['que'];?>
        </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <div class="ct">
        <input type="submit" value="我要投票">
    </div>
    </form>
</fieldset>

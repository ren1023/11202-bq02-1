<?php
$que=$Que->find(['id'=>$_GET['id']]);
?>
<fieldset>
    <legend>目前位置:首頁>問卷調查><span><?=$que['que'];?></span></legend>
     <h3><?=$que['que'];?></h3>
    <table style="width: 95%;">       
        
        <?php
        $rows=$Que->all(['big_id'=>$_GET['id']]);

        $total=($que['vote']!=0)?$que['vote']:1;
        foreach($rows as $row){
            
            $rate=round($row['vote']/$total,2);
            // echo $rate;
        ?>
        <tr>
        <td style="width: 55%;">
            <?=$row['que'];?>
        </td>
        <td>
            <div style="display: flex;">
            <div style="width:<?=($rate*40);?>%; background-color:#ccc; height:32px;"></div> <!-- 高度一定要加 -->
            <div><?=$row['vote'];?>票(<?=$rate*100;?>)%</div>
            </div>
        </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <div class="ct">
        <button type="button" onclick="location.href='?do=que'">返回</button>
    </div>
</fieldset>

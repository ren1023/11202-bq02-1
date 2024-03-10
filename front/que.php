<fieldset>
    <legend>目前位置:首頁>問卷調查</legend>
    <table style="width: 95%; margin:auto;"  class="ct">
        <tr class="ct">
            <th width:5%>編號</th>
            <th width:55%>問卷題目</th>
            <th width:10%>投票總數</th>
            <th width:10%>結果</th>
            <th width:10%>狀態</th>
        </tr>
        <?php
            $rows=$Que->all(['big_id'=>0]);
            foreach($rows as $idx=>$row){
        ?>
        <tr>
            <td><?=$idx+1;?></td>
            <td style=" text-align:left;"><?=$row['que'];?></td>
            <td><?=$row['vote'];?></td>
            <?php
            if(isset($_SESSION['user'])){
            ?>
            <td>
            <a href='?do=result&id=<?=$row['id'];?>'>結果</a>
            </td>
            <td>
            <a href='?do=vote&id=<?=$row['id'];?>'>參與投票</a>
            </td>
            <?php
                }else{
                    ?>
                    <td>
                    
                    </td>
                    <td>
                    請先登入
                    </td>
                <?php
                }
                ?>
        </tr>

        <?php
        }
        ?>
    </table>

</fieldset>
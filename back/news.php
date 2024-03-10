<form action="./api/edit_news.php" method="post">
<table style="width:95%; margin:auto; text-align:center;">
        <tr>
            <th width=10%>編號</th>
            <th width=50%>標題</th>
            <th width=10%>顯示</th>
            <th width=10%>刪除</th>
        </tr>
        <?php
        $total=$News->count();
        $div=3;
        $pages=ceil($total/$div);
        $now=$_GET['p']??1;
        $start=($now-1)*$div;

        $rows = $News->all(" limit $start,$div");
        foreach ($rows as $idx=>$row) {
        ?>
            <tr>
                <td class="clo"><?=($idx+$start+1).".";?></td>
                <td class="title" data-id="<?= $row['id']; ?>" style="cursor:pointer">
                    <?= $row['title']; ?>
                </td>
                <td>
                    <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?=($row['sh']==1)?'checked':'';?>>
                </td>
                <td>
                    <input type="checkbox" name="del[]" value="<?= $row['id']; ?>" >
                    <input type="hidden" name="id[]" value="<?= $row['id']; ?>" >
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div class="ct"> <!-- 分頁功能 -->
    <?php
        if($now>1){
            $prev=$now-1;
            echo "<a href='?do=$do&p=$prev'> < </a>";
        }
        for ($i=1;$i<=$pages;$i++){
            $fontsize=($now==$i)?'24px':'16px';
            echo "<a href='?do=$do&p=$i' style='font-size:$fontsize'> $i </a>";
        }
        if($now<$pages){
            $next=$now+1;
            echo "<a href='?do=$do&p=$next'> > </a>";
        }

    ?>
    </div>
    <div class="ct">
        <input type="submit" value="確定修改">
    </div>
    </form>
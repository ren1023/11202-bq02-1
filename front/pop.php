<style>
    .pop{
        width: 300px;
        height: 400px;
        min-height: 100px;
        z-index:999;
        position: fixed;
        overflow: auto;
        background-color: rgb(51,51,51,0.9);
        color:#ccc;
        display: none;

    }
</style>
<fieldset>
    <legend>目前位置:首頁>人氣文章區</legend>
    <table style="width:95%; margin:auto">
        <tr>
            <th width=30%>標題</th>
            <th width=50%>內容</th>
            <th>人氣</th>
        </tr>
        <?php
        $total = $News->count(['sh' => 1]);
        $div = 3;
        $pages = ceil($total / $div);
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * $div;

        $rows = $News->all(['sh' => 1], " order by `good` desc limit $start,$div");
        foreach ($rows as $row) {
        ?>
            <tr>
                <td class="title clo" data-id="<?= $row['id']; ?>" style="cursor:pointer">
                    <?= $row['title']; ?>
                </td>
                <td>
                    <div id="s<?= $row['id']; ?>">
                        <?= mb_substr($row['news'], 0, 25); ?>...
                    </div>
                    <div id="a<?= $row['id']; ?>" class="pop" >
                    <h4 style="color: lightblue;"><?=$row['title'];?></h4>
                        <?= $row['news']; ?>
                    </div>
                </td>
                <td>

                    <span id="<?= $row['good']; ?>">
                    <?php
                    $good=$News->find(['id'=>$row['id']]);
                    ?>
                    <?=$good['good'];?>個人說
                        <img src="./icon/02B03.jpg" style="width:25px">
                    </span>
                    <?php
                    if (isset($_SESSION['user'])) {
                        if ($Log->count(['news' => $row['id'], 'acc' => $_SESSION['user']]) > 0) {
                            echo "<a href='Javascript:good({$row['id']})'>收回讚</a>";
                        } else {
                            echo "<a href='Javascript:good({$row['id']})'>讚</a>";
                        }
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div class="ct"> <!-- 分頁功能 -->
        <?php
        if ($now > 1) {
            $prev = $now - 1;
            echo "<a href='?do=$do&p=$prev'> < </a>";
        }
        for ($i = 1; $i <= $pages; $i++) {
            $fontsize = ($now == $i) ? '24px' : '16px';
            echo "<a href='?do=$do&p=$i' style='font-size:$fontsize'> $i </a>";
        }
        if ($now < $pages) {
            $next = $now + 1;
            echo "<a href='?do=$do&p=$next'> > </a>";
        }

        ?>
    </div>
</fieldset>
<script>
    $('.title').hover(function() {
        let id = $(this).data('id');
        $(`#s${id},#a${id}`).toggle();
    })
</script>
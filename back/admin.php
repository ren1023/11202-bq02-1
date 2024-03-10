<fieldset>
    <legend>帳號管理</legend>
    <form action="./api/edit_user.php" method="post">
    <table style="margin: auto; width:55%">
    <tr class="ct">
        <td class="clo">帳號</td>
        <td class="clo">密碼</td>
        <td class="clo">刪除</td>
    </tr>
    <?php
    $rows=$User->all();
    foreach($rows as $row){
        if($row['acc']!='admin'){
    ?>
    <tr>
        <td><?=$row['acc'];?></td>
        <td><?=str_repeat("*",mb_strlen($row['pw']));?></td>
        <td>
            <input type="checkbox" name="del[]" value="<?=$row['id'];?>" >
        </td>
    </tr>
    <?php
    }
    }
    ?>
    </table>
    <div class="ct">
        <input type="submit" value="確定刪除">
        <input type="reset" value="清空選取">
    </div>
    </form>
</fieldset>
<h2>新增會員</h2>
<span style="color:red;">*請設定您要註冊的帳號及密碼(最長12個字元)</span>
    <table>
        <tr>
            <td class="clo">Step1:登入帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <td class="clo">Step2:登入密碼</td>
        <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <td class="clo">Step3:再次確密碼</td>
        <td><input type="password" name="pw2" id="pw2"></td>
        </tr>
        </tr>
        <td class="clo">Step4:信箱(忘記密碼時使用)</td>
        <td><input type="text" name="email" id="email"></td>
        </tr>
        <tr>
            <td>
                <button onclick="reg()">註冊</button>
                <button onclick="clean()">清除</button>
            </td>
        </tr>
    </table>
    <script>
    function reg() {
        let user = {
            acc: $('#acc').val(),
            pw: $('#pw').val(),
            pw2: $('#pw2').val(),
            email: $('#email').val()
        }

        if (user.acc != '' && user.pw != '' && user.pws != '' && user.email != '') {
            if (user.pw == user.pw2) {
                $.post('./api/chk_acc.php',{acc:user.acc},(res)=>{
                    if(parseInt(res)==1){//res會忽略，要注意
                        alert('帳號重複')
                    }else{
                        $.post('./api/reg.php', user, (res) => {
                            alert('註冊完成，歡迎加入')
                        })
                    }
                })
            } else {
                alert('密碼錯誤')
            }
        } else {
            alert('不可空白')
        }
    }

    function clean() {
        $("input[type='text'],input[type='password']").val(''); //input[type='text']，這個也常寫錯，要注意
    }
</script>
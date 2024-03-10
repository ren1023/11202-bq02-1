<fieldset style="width: 50%;">
    <legend>會員登入</legend>
    <table>
        <tr >
            <td class="clo">帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <td class="clo">密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>
                <button  onclick="login()">登入</button>
                <button onclick="clean()">清除</button>
            </td>
            <td>
                <a href="?do=forget">忘記密碼</a>
                <a href="?do=reg">尚未註冊</a>
            </td>
        </tr>
    </table>
</fieldset>
<script>
    function login(){
        let acc=$('#acc').val()
        let pw=$('#pw').val()
        $.post('./api/chk_acc.php',{acc},(res)=>{
            if(parseInt(res)==0){//res會忽略，要注意
                alert('查無帳號')
            }else{
                $.post('./api/chk_pw.php',{acc,pw},(res)=>{
                    if(parseInt(res)==1){//res會忽略，要注意
                        // console.log('test')
                        if(acc=='admin'){
                            location.href='back.php'
                        }else{
                            location.href='index.php'
                        }
                    }else{
                       alert('密碼錯誤')
                    }
                })
            }
        })
    }

    function clean(){
        $("input[type='text'],input[type='password']").val('');//input[type='text']，這個也常寫錯，要注意
    }
    
</script>
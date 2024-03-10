<div>
    <div>請輸入信箱以查詢密碼</div>
    <input type="text" name="email" id="email">
    <div id="result"></div>
    <button type="button" onclick="forget()">尋找</button>
</div>
<script>
    function forget(){
    let email=$('#email').val()
    $.get('./api/forget.php',{email},(pw)=>{
        console.log(pw);
        $('#result').text(pw);
    })
}
</script>

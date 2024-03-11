<style>
    .type-item{
        display: block;
        margin: 3px 6px;
    }
    .types,.news-list{
        display: inline-block;
        vertical-align: top;
    }
    .news-list{
        width:600px;
    }
</style>
<div class="nav">目前位置:首頁> 分類網誌><span class="type">建康新知</span></div>

<fieldset class="types">
    <legend>分類網誌</legend>
    <a class="type-item" data-id="1">健康新知</a>
    <a class="type-item" data-id="2">菸害防制</a>
    <a class="type-item" data-id="3">癌症防治</a>
    <a class="type-item" data-id="4">慢性病防治</a>
</fieldset>
<fieldset class="news-list">
    <legend>文章列表</legend>
    <div class="list-items" style="display:none;"></div>
    <div class="article"></div>
</fieldset>
<script>
    $('.type-item').on('click',function(){
        $('.type').text($(this).text());
        let type=$(this).data('id');
        getlist(type);
    })

    function getlist(type){
        $.get('./api/get_list.php',{type},(list)=>{
            $('.list-items').html(list);
            $('.list-items').show();
            $('article').hide();
        })
    }
</script>
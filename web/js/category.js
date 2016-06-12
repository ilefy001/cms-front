/**
 * Created by Administrator on 16-6-3.
 */

//获取顶级菜单
function getTopCategory(){
    $.ajax({
        url: 'index.php?r=category/get-top-category-list',
        type: 'POST',
        data: '',
        dataType: 'json',
        success: function(response) {
            var list = response.param.list;
            var cur_cat_id = $('#cur_cat_id').val();
            var category = '<li><a href="/index.php">首页</a></li>';
            if(cur_cat_id == '' || cur_cat_id == 'undefined' || cur_cat_id == null) {
                category = '<li class="active"><a href="/index.php">首页</a></li>';
            }
            $.each(list, function(index,item){
                var active = '';
                if(cur_cat_id == item.id){
                    active = 'active';
                }
                category += '<li id="top_menu_'+item.id+'" class="'+active+'"><a href="/index.php?r=category/view&id='+item.id+'">'+item.name+'</a></li>';
            });
            $('#top_category').html(category);
        }
    });
}


//获取内容列表
function getContentList(){
    var cur_cat_id = $('#cur_cat_id').val();
    $.ajax({
        url: 'index.php?r=content/get-content-list',
        type: 'POST',
        data: {category_id:cur_cat_id},
        dataType: 'json',
        success: function(response) {
            var list = response.param.list;
            var cur_cat_id = $('#cur_cat_id').val();
            var list_html = '';
            $.each(list, function(index,item){
                var title_html = '<a href="index.php?r=content/view&id='+item.id+'">'+item.title+'</a>';
                var time_html = '<span style="float: right;">'+item.create_time+'</span>';
                list_html += '<li class="list-group-item">'+title_html+time_html+'</li>';
            });
            $('#content_list').html(list_html);
        }
    });
}
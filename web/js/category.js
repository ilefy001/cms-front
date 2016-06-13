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
    var limit = 10;
    var page = $('#page').val();
    var cur_cat_id = $('#cur_cat_id').val();
    $.ajax({
        url: 'index.php?r=content/get-content-list',
        type: 'POST',
        data: {category_id:cur_cat_id,page:page},
        dataType: 'json',
        success: function(response) {
            var list = response.param.list;
            var cur_cat_id = $('#cur_cat_id').val();
            var total_count = response.param.total_count;
            var list_html = '';
            $.each(list, function(index,item){
                var title_html = '<a href="index.php?r=content/view&id='+item.id+'">'+item.title+'</a>';
                var time_html = '<span style="float: right;">'+item.create_time+'</span>';
                list_html += '<li class="list-group-item">'+title_html+time_html+'</li>';
            });
            $('#content_list').html(list_html);
            $('#total_count').text(total_count);
            var url = '/index.php?r=category/view&id='+cur_cat_id;
            pagination(limit,page,total_count,url);
        }
    });
}

//分页
function pagination(limit,page,total_count,url){
    limit = parseInt(limit);
    page = parseInt(page);
    total_count = parseInt(total_count);
    if(total_count<=limit) {
        return false;
    }

    var total_page = Math.ceil(total_count/limit);//总页数
    var pre_url = url+'&page='+(parseInt(page-1));
    var pre_html = '<li>'
        +'<a href="'+pre_url+'" aria-label="Previous">'
        +'<span aria-hidden="true">&laquo;</span>'
        +'</a>'
        +'</li>';
    //如果当前页是第一页
    if(page == 1) {
        pre_html = '<li class="disabled"><a href="javascript:void(0);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
    }

    var next_url = url+'&page='+(parseInt(page+1));
    var next_html = '<li>'
        +'<a href="'+next_url+'" aria-label="Next">'
        +'<span aria-hidden="true">&raquo;</span>'
        +'</a>'
        +'</li>';
    if(page == total_page) {
        next_html = '<li class="disabled"><a href="javascript:void(0);" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
    }

    var number_html='';
    //遍历打印数字按钮
    for(var i=1;i<=total_page;i++){
        var active = '';
        if(page == i){
            active = 'active';
        }
        var link_url = url+'&page='+i;
        number_html += '<li class="'+active+'"><a href="'+link_url+'">'+i+'</a></li>';
    }

    $('#pagination').html(pre_html+number_html+next_html);
    return true;
}
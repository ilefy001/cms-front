/**
 * Created by Administrator on 16-6-6.
 */
//获取上下文内容
function getPreNextContent(){
    var content_id = $('#content_id').val();
    var pre_next = '';
    $.ajax({
        url: 'index.php?r=content/get-pre-next-content',
        type: 'POST',
        data: {content_id:content_id},
        dataType: 'json',
        success: function(response) {
            var pre_content = response.param.pre_content;
            var next_content = response.param.next_content;
            if(pre_content) {
                pre_next += '<div><a href="index.php?r=content/view&id='+pre_content.id+'">上一篇：'+pre_content.title+'</a></div>';
            } else {
                pre_next += '<div>上一篇：没有了</div>';
            }

            if(next_content) {
                pre_next += '<div><a href="index.php?r=content/view&id='+next_content.id+'">下一篇：'+next_content.title+'</a></div>';
            } else {
                pre_next += '<div>下一篇：没有了</div>';
            }
            $('#pre_next').html(pre_next);
        }
    });
}

var category_br = '';
function joinBreadcrumb($categroy){
    if($categroy) {
        if($categroy.hasOwnProperty('parent')) {
            joinBreadcrumb($categroy['parent']);
        } else {
            $('#cur_cat_id').val($categroy.id);
            getTopCategory();
        }
        category_br += '<li><a href="/index.php?r=category/view&id='+$categroy.id+'">'+$categroy.name+'</a></li>';
    }
}

//获取面包屑
function getParentCategory() {
    var content_id = $('#content_id').val();
    var title = $('#title').text();
    var breadcrumb = '<li><a href="/index.php">首页</a></li>';
    $.ajax({
        url: 'index.php?r=content/get-parent-category',
        type: 'POST',
        data: {content_id:content_id},
        dataType: 'json',
        success: function(response) {
            var parent_category = response.param.parent_category;
            if(parent_category){
                joinBreadcrumb(parent_category);
                breadcrumb += category_br+'<li class="active">'+title+'</li>';
                $('#breadcrumb').html(breadcrumb);
            }
        }
    });
}


<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Content */

$this->title = $model->title;
?>

<ul id="breadcrumb" class="breadcrumb"></ul>

<div class="content-view">
    <div class="col-lg-12">
        <h2 class="text-center" id="title"><?= Html::encode($this->title) ?></h2>
        <p class="text-center">发布时间：<?= $model->create_time; ?></p>
        <div id="content" style="min-height: 500px;"><?= $model->fulltext; ?></div>
        <div id="pre_next"></div>
    </div>
</div>
<input type="hidden" id="content_id" value="<?= $model->id ?>">
<input type="hidden" id="cur_cat_id">

<script src="/ueditor/ueditor.parse.min.js"></script>
<script src="/js/content.js"></script>
<script type="text/javascript">
    //解析一些特殊的格式，比如表格
    uParse('#content', {
        rootPath: '/ueditor/'
    });

    $(function(){
        getPreNextContent();
        getParentCategory();
    });
</script>
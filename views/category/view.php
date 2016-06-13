<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view col-md-2 col-lg-2">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            Panel content
        </div>
    </div>
</div>
    <div class="col-md-10 col-lg-10">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Panel heading</div>
            <div class="panel-body">
                <p>...</p>
            </div>
            <!-- List group -->
            <ul class="list-group" id="content_list">
            </ul>
            <nav>
                <ul class="pagination" id="pagination"></ul>
            </nav>
            <div>共<span id="total_count"></span>条</div>
        </div>
    </div>
    <input type="hidden" id="cur_cat_id" value="<?php echo $model->id; ?>">
    <input type="hidden" id="page" value="<?= $page ?>">

<script type="text/javascript">
    $(function(){
        getContentList();
    });
</script>
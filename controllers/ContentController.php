<?php

namespace app\controllers;

use Yii;
use app\models\Content;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use WebServiceResult;
use CategoryManage;

/**
 * ContentController implements the CRUD actions for Content model.
 */
class ContentController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionGetContentList(){
        $rt = new WebServiceResult;
        $category_id = intval($_REQUEST['category_id']);

        if($category_id <= 0) {
            $rt->SetResult('false');
            $rt->PrintFormatByEncodeJson();
        }

        $category_list = \app\models\Content::find()
            ->where(['category_id' => $category_id])
            ->orderBy('id')
            ->limit(10)
            ->all();
        $rt->SetParam('list',$category_list);
        $rt->PrintFormatByEncodeJson();
    }

    /**
     * Displays a single Content model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //获取上下文
    public function actionGetPreNextContent(){
        $rt = new WebServiceResult;
        $content_id = intval($_REQUEST['content_id']);
        $Content = new Content();
        $Info =$Content::find()->where(['id' => $content_id])->one();
        if(!empty($Info)) {
            $pre = $Content::find()
                ->where("id<{$Info->id} AND category_id= {$Info->category_id}")
                ->limit(1)
                ->one();
            $rt->SetParam('pre_content',$pre);
            $next = $Content::find()
                ->where("id>{$Info->id} AND category_id= {$Info->category_id}")
                ->limit(1)
                ->one();
            $rt->SetParam('next_content',$next);
        }
        $rt->PrintFormatByEncodeJson();
    }

    //获取面包屑
    public function actionGetParentCategory(){
        $rt = new WebServiceResult;
        $content_id = intval($_REQUEST['content_id']);
        $Content = new Content();
        $Info =$Content::find()->where(['id' => $content_id])->one();
        if(!empty($Info)) {
            $CategoryManage = new CategoryManage;
            $parent_category = $CategoryManage->getParentCategory($Info->category_id);
            $rt->SetParam('parent_category',$parent_category);
        }
        $rt->PrintFormatByEncodeJson();
    }

    /**
     * Finds the Content model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Content the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Content::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

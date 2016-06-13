<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use WebServiceResult;
use CategoryManage;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']):1;    //当前页
        return $this->render('view', [
            'model' => $this->findModel($id),
            'page'=>$page
        ]);
    }

    public function actionGetCategoryList(){
        $rt = new WebServiceResult;
        $CategoryManage = new CategoryManage();
        $category_list = $CategoryManage->getCategoryList();
        $rt->SetParam('list',$category_list);
        $rt->PrintFormatByEncodeJson();
    }

    public function actionGetTopCategoryList(){
        $rt = new WebServiceResult;
        $category_list = \app\models\Category::find()
            ->where(['parent_id' => 0])
            ->orderBy('id')
            ->all();
        $rt->SetParam('list',$category_list);
        $rt->PrintFormatByEncodeJson();
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace app\controllers;

use Yii;
use app\modules\admin\models\Request;
use app\modules\admin\models\RequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\modules\admin\controllers\RequestController;

class FrontController extends RequestController
{
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['created_by'=> \Yii::$app->user->id])->orderBy('created_at DESC '); // Выбор всех записей текущего рпользователя и сортировка

        $count = Request::find()->where(['status' => 'Решена'])->count();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'count' => $count
        ]);
    }
}
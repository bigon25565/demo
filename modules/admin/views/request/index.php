<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Requests';
$this->params['breadcrumbs'][] = $this->title;

?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'category_id',
                'value' => 'category.name',
                'filter' => \yii\helpers\ArrayHelper::map(\app\modules\admin\models\Category::find()->all(), 'id', 'name'),
            ],
            // 'id',
            'status',
            'name',
            'status',
            'name',
            [
                'attribute' => 'before_img',
                'value' => function($model) {
                    return Html::img($model->before_img, ['width'=>100, 'height' => 100]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'after_img',
                'value' => function($model) {
                    return Html::img($model->after_img, ['width'=>100, 'height' => 100]);
                },
                'format' => 'html',
            ],
            'why_not',
            //'created_at',
            //'created_by',
            //'category_id',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

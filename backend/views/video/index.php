<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Video', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                    'attribute' => 'video_id',
                'content' => function($model){
        return $this->render('_video_item', ['model'=>$model]);
                }
            ],
            [
                    'attribute' => 'status',
                'content'=> function($model){
                    return $model->getStatusLabels()[$model->status];
                }
            ],
            //'ha_thumbnail',
            //'video_name',
            'created_at:dateTime',
            'updated_at:dateTime',
            //'created_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

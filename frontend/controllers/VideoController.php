<?php


namespace frontend\controllers;


use common\models\Video;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\web\Controller;
use yii\web\NotAcceptableHttpException;

class VideoController extends Controller
{
   public function actionIndex(){
       $dataProvider = new ActiveDataProvider([
           'query' => Video::find()->published()->latest(),
       ]);

       return $this->render('index',
           [
               'dataProvider' => $dataProvider
           ]);

   }
   public function actionView($id){
       $video = Video::findOne($id);
       if (!$video){
           throw new NotAcceptableHttpException("Video does not exist");
       }
       return $this->render('view',
           ['model' => $video]);
   }
}
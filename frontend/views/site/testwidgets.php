<?php
namespace app\Component;
use yii\base\Component;
use yii\bootstrap4\Progress;
use yii\base\Widget;
?>
<?php
 Progress::widget(
     [
         'percent' => '60',
         'label' => 'progress 60%',
     ]
 );

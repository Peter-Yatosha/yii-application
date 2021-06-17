<?php
/**
 * @var $model \common\models\Video
 */

use yii\helpers\Url;

?>
<div class="card m-3" style="width: 14rem;">
   <a href="<?php echo Url::to(['video/view', 'id'=> $model->video_id])?>">
       <div class="embed-responsive embed-responsive-16by9 ">
           <video class="embed-responsive-item"
                  poster="<?php echo $model->getThumbLink(); ?>"
                  src="<?php echo $model->getVideoLink(); ?>" controls>
           </video>
       </div>
   </a>
    <div class="card-body p-2" >
        <h6 class="card-title m-0">
            <?php echo $model->title ?>
        </h6>
        <p class="card-text m-0">
            <?php //echo $model->CreatedBy->username; ?>
        </p>
        <p class="card-text m-0">
            149 Views. <?php echo Yii::$app->formatter->asDate($model->created_at); ?>
        </p>
    </div>
</div>


<?php
/**
 * @var  $model Video
 */

use common\models\Video;

?>

<div class="row">
    <div class="col-md-8">
        <div class="embed-responsive embed-responsive-16by9 ">
            <video class="embed-responsive-item"
                   poster="<?php //echo $model->getThumbLink(); ?>"
                   src="<?php echo $model->getVideoLink(); ?>" controls>
            </video>
        </div>
    </div>
    <div class="col-4">

    </div>
</div>
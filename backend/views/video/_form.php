<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\video */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <div class="row">
        <div class="col-sm-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            <div class="form-group">
                <label>
                    <?php echo $model->getAttributeLabel('Thumbnail')?>
                </label>
                <div class="custom-file">
                    <input type="file" id="thumbnail" name="thumbnail" class="custom-file-input">
                    <label for="thumbnail" class="custom-file-label">Choose Thumbnail</label>
                </div>
            </div>

            <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-4">
            <div class="embed-responsive embed-responsive-16by9 mb-3">
                 <video class="embed-responsive-item"
                        poster="<?php echo $model->getThumbLink(); ?>"
                        src="<?php echo $model->getVideoLink(); ?>" controls>
                 </video>
            </div>
            video

            <div class="mb-3">
                <div class="text-muted">Video Link</div>
                <a href="<?php echo $model->getVideoLink()?>">
                    Ope Video
                </a>
            </div>
            <div class="mb-3">
                <div class="text-muted">Video Name</div>
                <?php echo $model->video_name?>
            </div>
            <?= $form->field($model, 'status')->dropdownList($model->getStatusLabels()) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

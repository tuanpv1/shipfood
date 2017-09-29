<?php

use common\models\Banner;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
$avatarPreview = !$model->isNewRecord && !empty($model->image);

?>

<div class="form-body">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 8,
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(\kartik\file\FileInput::classname(), [
        'pluginOptions' => [

            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' => 'Chọn hình ảnh',
            'initialPreview' => $avatarPreview ? [
                Html::img(Yii::getAlias('@web') . '/' . Yii::getAlias('@image_banner') . "/" . $model->image, ['class' => 'file-preview-image', 'style' => 'width: 100%;']),

            ] : [],
        ],
        'options' => [
            'accept' => 'image/*',
        ],
    ])->hint(Yii::t('app','Vui lòng tải hình ảnh có kích thước 1920*700 px để hiển thị tốt nhất '));
    ?>

    <?= $form->field($model, 'des')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList(Banner::getListStatus()) ?>

    <div class="row text-center">
        <?= Html::submitButton($model->isNewRecord ?  Yii::t('app','Tạo mới') : Yii::t('app','Cập nhật'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Hủy'), ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

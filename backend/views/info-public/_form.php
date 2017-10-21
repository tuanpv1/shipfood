<?php

use common\models\InfoPublic;
use kartik\file\FileInput;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\InfoPublic */
/* @var $form yii\widgets\ActiveForm */

$avatarPreview = !$model->isNewRecord && !empty($model->image_header);
$androidPreview = !$model->isNewRecord && !empty($model->image_android);
$iosPreview = !$model->isNewRecord && !empty($model->image_ios);

?>

<div class="form-body">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 8,
    ]); ?>
    <?= $form->field($model, 'image_header')->widget(\kartik\file\FileInput::classname(), [
        'pluginOptions' => [

            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' => 'Chọn hình ảnh',
            'initialPreview' => $avatarPreview ? [
                Html::img(Yii::getAlias('@web') . '/' . Yii::getAlias('@image_banner') . "/" . $model->image_header, ['class' => 'file-preview-image', 'style' => 'width: 100%;']),

            ] : [],
        ],
        'options' => [
            'accept' => 'image/*',
        ],
    ])->hint(Yii::t('app','Vui lòng tải hình ảnh có tỉ lệ 1:1 ví dụ 110px*110px để hiển thị tốt nhất '));
    ?>

    <?= $form->field($model, 'image_android')->widget(\kartik\file\FileInput::classname(), [
        'pluginOptions' => [

            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' => 'Chọn hình ảnh',
            'initialPreview' => $androidPreview ? [
                Html::img(Yii::getAlias('@web') . '/' . Yii::getAlias('@image_banner') . "/" . $model->image_android, ['class' => 'file-preview-image', 'style' => 'width: 100%;']),

            ] : [],
        ],
        'options' => [
            'accept' => 'image/*',
        ],
    ])->hint(Yii::t('app','Vui lòng tải hình ảnh có tỉ lệ 1:1 ví dụ 110px*110px để hiển thị tốt nhất '));
    ?>

    <?= $form->field($model, 'image_ios')->widget(\kartik\file\FileInput::classname(), [
        'pluginOptions' => [

            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' => 'Chọn hình ảnh',
            'initialPreview' => $iosPreview ? [
                Html::img(Yii::getAlias('@web') . '/' . Yii::getAlias('@image_banner') . "/" . $model->image_ios, ['class' => 'file-preview-image', 'style' => 'width: 100%;']),

            ] : [],
        ],
        'options' => [
            'accept' => 'image/*',
        ],
    ])->hint(Yii::t('app','Vui lòng tải hình ảnh có tỉ lệ 1:1 ví dụ 110px*110px để hiển thị tốt nhất '));
    ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'image_footer')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'image_menu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link_face')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'youtube')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'link_android')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'link_ios')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Tạo mới') : Yii::t('app','Cập nhật'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Huỷ', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

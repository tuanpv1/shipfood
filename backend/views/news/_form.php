<?php

use common\models\AffiliateCompany;
use common\models\News;
use common\widgets\Player;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
$videoPreview = !$model->isNewRecord && !empty($model->video);
// http://kcfinder.sunhater.com/install#dynamic
$kcfOptions = array_merge(\common\widgets\CKEditor::$kcfDefaultOptions, [
    'uploadURL' => Yii::getAlias('@web') . '/upload/image_news',
    'access' => [
        'files' => [
            'upload' => true,
            'delete' => true,
            'copy' => true,
            'move' => true,
            'rename' => true,
        ],
        'dirs' => [
            'create' => true,
            'delete' => true,
            'rename' => true,
        ],
    ],
]);

// Set kcfinder session options
?>

<div class="form-body">

    <?php $form = ActiveForm::begin(
        [
            'options' => ['enctype' => 'multipart/form-data'],
            'method' => 'post',
        ]
    ); ?>

    <?= $form->field($model, 'type')->hiddenInput(['id' => 'type'])->label(false) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(\common\models\News::listStatus()) ?>

    <?=
    $form->field($model, 'thumbnail[]')->widget(\kartik\widgets\FileInput::classname(), [
        'options' => [
            'multiple' => true,
            'accept' => 'image/*',
            'style' => 'width: 100%;'

        ],
        'pluginOptions' => [
            'uploadUrl' => \yii\helpers\Url::to(['/news/upload-file']),
            'uploadExtraData' => [
                'type' => News::IMAGE_TYPE_THUMBNAIL,
                'thumbnail_old' => $model->thumbnail
            ],
            'allowedFileExtensions' => ['jpg', 'gif', 'jpeg', 'png'],
            'showUpload' => false,
            'showRemove' => true,
            'maxFileSize' => News::MAX_SIZE_UPLOAD,
            'maxFileCount' => 10,
            'minFileCount' => 1,
            'initialPreview' => $thumbnailPreview,
            'initialPreviewConfig' => $thumbnailInit,

        ],
        'pluginEvents' => [
            "fileuploaded" => "function(event, data, previewId, index) {
                var response=data.response;
                console.log(response.success);
                console.log(response);
                if(response.success){
                    console.log(response.output);
                    var current_screenshots=response.output;
                    var old_value_text=$('#images_tmp').val();
                    console.log('xxx'+old_value_text);
                    if(old_value_text !=null && old_value_text !='' && old_value_text !=undefined)
                    {
                        var old_value=jQuery.parseJSON(old_value_text);

                        if(jQuery.isArray(old_value)){
                            console.log(old_value);
                            old_value.push(current_screenshots);

                        }
                    }
                    else{
                        var old_value= [current_screenshots];
                    }
                    $('#images_tmp').val(JSON.stringify(old_value));
                 }
            }",
            "fileclear" => "function() {  console.log('delete'); }",
            "filedeleted" => "function(event, key) {
                    var image_deleted=key;
                    var old_value_text=$('#images_tmp').val();
                        var old_value=jQuery.parseJSON(old_value_text);

                        if(jQuery.isArray(old_value)){
                            var arrLength=old_value.length;

                            for (i = 0; i < old_value.length; i++) {
                                var row=old_value[i];
                                if(image_deleted == row['name']){

                                    old_value.splice(i,1);
                                    console.log(old_value);
                                }
                            }
                        }
                    else{
                        var old_value= [current_screenshots];
                    }
                    $('#images_tmp').val(JSON.stringify(old_value));
                }"
        ],

    ]) ?>
    <?php if ($type == News::TYPE_DV){ ?>
    </p>Vui lòng upload hình ảnh có kích thước 460*300 px Để hiển thị tốt nhất <p>
        <?php } ?>
        <?php if ($type != News::TYPE_ABOUT && $type != News::TYPE_KH) { ?>
            <?=
            $form->field($model, 'image_des[]')->widget(\kartik\widgets\FileInput::classname(), [
                'options' => [
                    'multiple' => true,
                    'accept' => 'image/*',
                    'style' => 'width: 100%;'

                ],
                'pluginOptions' => [
                    'uploadUrl' => \yii\helpers\Url::to(['/news/upload-file']),
                    'uploadExtraData' => [
                        'type' => News::IMAGE_TYPE_DES,
                        'image_des_old' => $model->image_des
                    ],
                    'allowedFileExtensions' => ['jpg', 'gif', 'jpeg', 'png'],
                    'showUpload' => false,
                    'showRemove' => true,
                    'maxFileSize' => News::MAX_SIZE_UPLOAD,
                    'maxFileCount' => 10,
                    'minFileCount' => 1,
                    'initialPreview' => $imageDesPreview,
                    'initialPreviewConfig' => $imageDesInit,
                ],
                'pluginEvents' => [
                    "fileuploaded" => "function(event, data, previewId, index) {
                var response=data.response;
                console.log(response.success);
                console.log(response);
                if(response.success){
                    console.log(response.output);
                    var current_screenshots=response.output;
                    var old_value_text=$('#images_tmp').val();
                    console.log('xxx'+old_value_text);
                    if(old_value_text !=null && old_value_text !='' && old_value_text !=undefined)
                    {
                        var old_value=jQuery.parseJSON(old_value_text);

                        if(jQuery.isArray(old_value)){
                            console.log(old_value);
                            old_value.push(current_screenshots);

                        }
                    }
                    else{
                        var old_value= [current_screenshots];
                    }
                    $('#images_tmp').val(JSON.stringify(old_value));
                 }
            }",
                    "fileclear" => "function() {  console.log('delete'); }",
                    "filedeleted" => "function(event, key) {
                    var image_deleted=key;
                    var old_value_text=$('#images_tmp').val();
                        var old_value=jQuery.parseJSON(old_value_text);

                        if(jQuery.isArray(old_value)){
                            var arrLength=old_value.length;

                            for (i = 0; i < old_value.length; i++) {
                                var row=old_value[i];
                                if(image_deleted == row['name']){

                                    old_value.splice(i,1);
                                    console.log(old_value);
                                }
                            }
                        }
                    else{
                        var old_value= [current_screenshots];
                    }
                    $('#images_tmp').val(JSON.stringify(old_value));
                }"
                ],

            ]) ?>
        <?php } ?>

        <?= $form->field($model, 'short_description')->textarea(['rows' => 4]) ?>

        <?php if ($type != News::TYPE_KH) { ?>
            <?php echo $form->field($model, 'content')->widget(\common\widgets\CKEditor::className(), [
//            'options' => [
//                'rows' => 8,
//            ],
                'preset' => 'full',
            ]);
            $_SESSION['KCFINDER'] = array(
                'disabled' => false
            ); ?>
        <?php } ?>

        <?php if ($type == News::TYPE_DV) { ?>
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

            <?=
            $form->field($model, 'honor')->textInput(['maxlength' => true])->hint('Thời gian được tính bằng phút')
            ?>
        <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tạo mới') : Yii::t('app', 'Cập nhật'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

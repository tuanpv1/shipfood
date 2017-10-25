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

$images = !$model->isNewRecord && !empty($model->images);

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
$check = Html::getInputId($model, 'honor');
// Set kcfinder session options

$js = <<<JS
    $("#$check").change(function() {
        if($('#$check').is(':checked')){
            $('#id_is_honor').show('slow');
        }else {
            $('#id_is_honor').hide('slow');
        }
    });
JS;
$js_default = <<<JS
     if($('#$check').is(':checked')){
            $('#id_is_honor').show();
        }else {
            $('#id_is_honor').hide();
        }
JS;
$this->registerJs($js_default, \yii\web\View::POS_READY);
$this->registerJs($js, \yii\web\View::POS_READY);
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

    <?php if($type == News::TYPE_FOOD_LUNCH || $type == News::TYPE_FOOD_MORNING){ ?>
    <?= $form->field($model, 'honor')->checkbox() ?>
        <div id="id_is_honor">
            <?= $form->field($model, 'description')->textarea(['rows'=>8]) ?>
        </div>
    <?php } ?>

    <?= $form->field($model, 'images')->widget(\kartik\file\FileInput::classname(), [
        'pluginOptions' => [

            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' => 'Chọn hình ảnh',
            'initialPreview' => $images ? [
                Html::img(Yii::getAlias('@web') . '/' . Yii::getAlias('@image_news') . "/" . $model->images, ['class' => 'file-preview-image', 'style' => 'width: 100%;']),

            ] : [],
        ],
        'options' => [
            'accept' => 'image/*',
        ],
    ]);
    ?>

    <?php
    if($type == News::TYPE_FOOD_MORNING || $type == News::TYPE_FOOD_LUNCH || $type == News::TYPE_ABOUT){
        echo  "<p style='color: red'>Vui lòng upload hình ảnh đúng kích thước theo tỉ lệ 1:1 ví dụ 200px * 200px đối với ảnh đồ ăn thương hiêu chất lượng tối thiểu phải là 7  00px*700px<p>";
    }
    if($type == News::TYPE_VEGETABLES_LK || $type == News::TYPE_VEGETABLES_SX){
        echo  "<p style='color: red'>Vui lòng upload hình ảnh đúng kích thước theo tỉ lệ 1,3:1 ví dụ 276px * 200px<p>";
    }
    ?>

    <?= $form->field($model, 'short_description')->textarea(['rows' => 4]) ?>

    <?php if($type == News::TYPE_FOOD_LUNCH || $type == News::TYPE_FOOD_MORNING){
        echo  "<p style='color: red'>Để trên website hiện xuống dòng nhập dấu . tại vị trí muốn xuống dòng<p>";
    } ?>

    <?php $list_type = [News::TYPE_NEWS,News::TYPE_ABOUT];
    if (!in_array($type,$list_type)) { ?>

        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?php } if($type == News::TYPE_ABOUT || $type == News::TYPE_VEGETABLES_LK || $type == News::TYPE_VEGETABLES_SX || $type == News::TYPE_NEWS){ ?>

        <?= $form->field($model, 'content')->widget(\common\widgets\CKEditor::className(), [
            'preset' => 'full',
        ]);
        $_SESSION['KCFINDER'] = array(
            'disabled' => false
        );
        ?>

    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tạo mới') : Yii::t('app', 'Cập nhật'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

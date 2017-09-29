<?php

use common\models\Book;
use common\models\News;
use kartik\datecontrol\DateControl;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-body">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 8,
    ]); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time_start')->widget(DateControl::classname(), [
        'type' => DateControl::FORMAT_DATETIME,
        'displayFormat' => 'd-M-y H:i',
        'saveFormat' => 'php:U',
        'displayTimezone' => 'Asia/Ho_Chi_Minh',
    ]);
    ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_dv')->widget(
        Select2::classname(),
        [ 'data'=>ArrayHelper::map(News::find()->andWhere(['status' => News::STATUS_ACTIVE, 'type' => News::TYPE_DV])->all(),'id','title') ]
    ); ?>

    <?= $form->field($model, 'status')->dropDownList(Book::listStatus()) ?>

    <?= $form->field($model, 'old')->textInput() ?>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tạo mới') : Yii::t('app', 'Cập nhật'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Huỷ', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

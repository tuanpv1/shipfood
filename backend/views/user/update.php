<?php

use common\assets\ToastAsset;
use kartik\grid\GridView;
use yii\web\View;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use common\models\AuthItem;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Cập nhật Tài khoản '.$model->getTypeName();
$this->params['breadcrumbs'][] = ['label' => 'Tài khoản '.$model->getTypeName(), 'url' => ['index', 'type' => $model->type]];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="row">
    <div class="col-md-12">

        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-gift"></i> <?php echo $this->title; ?></div>
            </div>
            <div class="portlet-body form">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Khôi phục mật khẩu
                </div>
            </div>
            <div class="portlet-body form">
                <?= $this->render('_form_change_password', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>

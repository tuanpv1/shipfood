<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Email */

$this->title = Yii::t('app','Cập nhật Email: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Danh sách đăng kí nhận tin'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Cập nhật');
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"> <i class="fa fa-gift"></i><?=$this->title?></div>
            </div>
            <div class="portlet-body form">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>

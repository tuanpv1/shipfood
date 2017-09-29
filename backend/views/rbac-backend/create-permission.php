<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AuthItem */

$this->title = 'Create Permission';
$this->params['breadcrumbs'][] = ['label' => 'Permissions Backend', 'url' => ['permission']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i><?= $this->title ?>
                </div>
            </div>
            <div class="portlet-body">

                <?= $this->render('_form-permission', [
                    'model' => $model,
                ]) ?>

            </div>
        </div>

    </div>
</div>

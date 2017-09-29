<?php

use kartik\widgets\Select2;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\detail\DetailView;
use common\models\User;


/* @var $this yii\web\View */
/* @var $model common\models\User */

?>
<div class="portlet-body form">
    <?= DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'attributes' => [
            ['attribute' => 'username', 'format' => 'raw', 'value' => '<kbd>' . $model->username . '</kbd>', 'displayOnly' => true],
            [
                'label' => 'Họ tên',
                'format' => 'html',
                'value' => $model->fullname,
            ],
            'email:email',
            'phone_number',
            [
                'attribute' => 'status',
                'label' => 'Trạng thái',
                'format' => 'raw',
                'value' => ($model->status == User::STATUS_ACTIVE) ?
                    '<span class="label label-success">' . $model->getStatusName() . '</span>' :
                    '<span class="label label-danger">' . $model->getStatusName() . '</span>',
                'type' => DetailView::INPUT_SWITCH,
                'widgetOptions' => [
                    'pluginOptions' => [
                        'onText' => 'Active',
                        'offText' => 'Delete',
                    ]
                ]
            ],
            [                      // the owner name of the model
                'attribute' => 'created_at',
                'label' => 'Ngày tham gia',
                'value' => date('d/m/Y H:i:s', $model->created_at),
            ],
            [                      // the owner name of the model
                'attribute' => 'updated_at',
                'label' => 'Ngày thay đổi thông tin',
                'value' => date('d/m/Y H:i:s', $model->updated_at),
            ],

//                        'type',
//                        'service_provider_id',
//                        'content_provider_id',
//                        'parent_id',
        ],
    ]) ?>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Hủy', ['index', 'type' => $model->type], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
</div>


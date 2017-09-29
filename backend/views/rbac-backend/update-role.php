<?php

use common\assets\ToastAsset;
use kartik\widgets\ActiveForm;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\AuthItem */

$this->title = 'Cập nhật nhóm quyền: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Quản lý nhóm quyền', 'url' => ['role']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view-role', 'name' => $model->name]];
$this->params['breadcrumbs'][] = $this->title;

ToastAsset::register($this);
ToastAsset::config($this, [
    'positionClass' => ToastAsset::POSITION_TOP_RIGHT
]);
?>


<div class="row">

    <div class="col-md-6">

        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>
                    Thông tin chung
                </div>
            </div>
            <div class="portlet-body">

                <?= $this->render('_form-role', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>

    </div>
    <?php
    $formID= "add-permission-form";
    $childrenGridId ='rbac-role-children';

    $revokeUrl = \yii\helpers\Url::to(['rbac-backend/role-revoke-auth-item']);

    $js = <<<JS
function revokeItem(item){
    if(confirm("Bạn có thực sự muốn xóa quyền '" + item + "' khỏi nhóm quyền '" + "$model->name" + "' không?")){
    jQuery.post(
        '{$revokeUrl}'
        ,{ parent: "$model->name", child:item}
        )
        .done(function(result) {
            if(result.success){
                toastr.success(result.message);
                jQuery.pjax.reload({container:'#{$childrenGridId}'});
            }else{
                toastr.error(result.message);
            }
        })
        .fail(function() {
            toastr.error("server error");
    });
    }
}
JS;

    $this->registerJs($js, View::POS_END);

    $js = <<<JS
// get the form id and set the event
jQuery('#{$formID}').on('beforeSubmit', function(e) {
    \$form = jQuery('#{$formID}');
   $.post(
        \$form.attr("action"), // serialize Yii2 form
        \$form.serialize()
    )
        .done(function(result) {
            if(result.success){
                toastr.success(result.message);
                jQuery.pjax.reload({container:'#{$childrenGridId}'});
            }else{
                toastr.error(result.message);
            }
        })
        .fail(function() {
            toastr.error("server error");
        });
    return false;
}).on('submit', function(e){
    e.preventDefault();
});
JS;
    $this->registerJs($js, View::POS_END);
    ?>
    <div class="col-md-6">

        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>
                    Quyền và nhóm quyền
                </div>
            </div>
            <div class="portlet-body">
                <h3>Nhóm quyền cha</h3>
                <?= GridView::widget([
                    'id' => 'rbac-role-parent',
                    'dataProvider' => $model->getParentProvider(),
                    'responsive' => true,
                    'pjax' => false,
                    'hover' => true,
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                            'attribute' => 'name',
                            'format' => 'html',
                            'value' => function ($model, $key, $index, $widget) {
                                /**
                                 * @var $model \common\models\AuthItem
                                 */
//                                $res = Html::a($model->name, ['rbac-backend/update-role', 'name' => $model->name]);
                                $res = $model->name;
                                $res .= " [" . sizeof($model->children) . "]";
                                return $res;
                            },
                        ],
                        'description',
                    ],
                ]); ?>
                <h3>Quyền/nhóm quyền con</h3>
                <?= GridView::widget([
                    'id' => $childrenGridId,
                    'dataProvider' => $model->getChildrenProvider(),
                    'responsive' => true,
                    'pjax' => true,
                    'hover' => true,
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                            'attribute' => 'name',
                            'format' => 'html',
                            'vAlign' => 'middle',
                            'value' => function ($model, $key, $index, $widget) {
                                /**
                                 * @var $model \common\models\AuthItem
                                 */
                                $action = $model->type == \common\models\AuthItem::TYPE_ROLE?'rbac-backend/update-role':'rbac-backend/update-permission';
//                                $res = Html::a($model->name, [$action, 'name' => $model->name]);
                                $res = $model->name;
                                if ($model->type == \common\models\AuthItem::TYPE_ROLE) {
                                    $res .= " [" . sizeof($model->children) . "]";
                                }
                                return $res;
                            },
                        ],
                        [
                            'attribute' => 'description',
                            'vAlign' => 'middle',
                        ],
                        [
                            'attribute' => 'type',
                            'header' => 'Loại',
                            'format' => 'html',
                            'vAlign' => 'middle',
                            'value' => function ($model, $key, $index, $widget) {
                                /**
                                 * @var $model \common\models\AuthItem
                                 */
                                $res = $model->type == \common\models\AuthItem::TYPE_PERMISSION?"Quyền" : "Nhóm quyền";
                                return $res;
                            },
                        ],
                        ['class' => 'yii\grid\ActionColumn',
                            'template' => '{revoke}',
                            'buttons'=> [
                                'revoke' => function ($url, $model1, $key) {
                                    return Html::button('<i class="glyphicon glyphicon-remove-circle"></i> Xóa', [
                                        'type' => 'button',
                                        'title' => 'Xóa quyền',
                                        'class' => 'btn btn-danger',
                                        'onclick' => "revokeItem('$model1->name');"
                                    ]);
                                },
                            ],
                        ],
                    ],
                ]); ?>

                <h3>Thêm quyền/nhóm quyền con</h3>
                <?php

                $form = ActiveForm::begin([
                    'id' => $formID,
                    'action' => ['rbac-backend/role-add-auth-item', 'name' => $model->name]
                ]);
                ?>

                <div class="form-group">
                <?php

                $roles = \yii\helpers\ArrayHelper::map($model->getMissingRoles(), "name", "name");
                $permissions = \yii\helpers\ArrayHelper::map($model->getMissingPermissions(), "name", "name");
                $data = ["Nhóm quyền" => $roles,"Quyền" => $permissions];
                echo Select2::widget([
                    'name' => 'addItems',
                    'data' => $data,
                    'options' => [
                        'placeholder' => 'Chọn quyền/nhóm quyền ...',
                        'multiple' => true
                    ],
                ]);
                ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Thêm quyền',
                        ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>

<?php

use common\models\Banner;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'QL Banner';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span
                        class="caption-subject font-green-sharp bold uppercase"><?= $this->title ?> </span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>

            <p>
                <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <div class="portlet-body">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],

//                        'id',
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'image',
                            'format' => 'html',
                            'value' => function ($model, $key, $index, $widget) {
                                return Html::img(Yii::getAlias('@web') . "/" . Yii::getAlias('@image_banner') . "/" .$model->image, ['width' => '250px']);
                            },
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'name',
                            'format' => 'html',
                            'value' => function ($model, $key, $index, $widget) {
                                return Html::a($model->name, ['view', 'id' => $model->id], ['class' => 'label label-primary']);
                            },
                        ],
                        'des:ntext',
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'status',
                            'width' => '120px',
                            'format' => 'raw',
                            'value' => function ($model, $key, $index, $widget) {
                                /**
                                 * @var $model common\models\Banner
                                 */
                                if ($model->status == Banner::STATUS_ACTIVE) {
                                    return '<span class="label label-success">' . $model->getStatusName() . '</span>';
                                } else {
                                    return '<span class="label label-danger">' . $model->getStatusName() . '</span>';
                                }

                            },
                            'filter' => Banner::getListStatus(),
                            'filterType' => GridView::FILTER_SELECT2,
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => "Tất cả"],
                        ],

                        ['class' => 'kartik\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

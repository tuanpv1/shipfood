<?php

use common\models\News;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Book */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase"><?= $this->title ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body">

                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'full_name',
                        'old',
                        'phone',
                        [
                            'attribute' => 'id_dv',
                            'value' => News::findOne($model->id_dv)->title,
                        ],
                        [
                            'attribute' => 'status',
                            'value' => $model->getStatusName(),
                        ],
                        [
                            'attribute' => 'time_start',
                            'value' => date('d/m/Y H:i:s', $model->time_start),
                        ],
                        [
                            'attribute' => 'created_at',
                            'value' => date('d/m/Y H:i:s', $model->created_at),
                        ],
                        [
                            'attribute' => 'updated_at',
                            'value' => date('d/m/Y H:i:s', $model->updated_at),
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>


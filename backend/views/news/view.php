<?php

use common\models\News;
use kartik\detail\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => News::getTypeName($model->type), 'url' => ['index', 'type' => $model->type]];
$this->params['breadcrumbs'][] = $this->title;

$i_want_to_see_it = false;
if ($model->type == News::TYPE_ABOUT ||
    $model->type == News::TYPE_VEGETABLES_SX ||
    $model->type == News::TYPE_VEGETABLES_LK ||
    $model->type == News::TYPE_NEWS) {
    $i_want_to_see_it = true;
}
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
                    <?= Html::a('Cập nhật', ['update', 'id' => $model->id, 'type' => $model->type], ['class' => 'btn btn-primary']) ?>
                    <?php if ($model->type != News::TYPE_ABOUT) { ?>
                        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Bạn chắc chắn muốn xóa ' . $model->title . '?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php } ?>
                </p>
                <div class="tabbable-custom nav-justified">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'title',
                            [
                                'attribute' => 'images',
                                'format' => 'html',
                                'value' => Html::img(Yii::getAlias('@web') . "/" . Yii::getAlias('@image_news') . "/" . $model->images, ['height' => '200px']),
                            ],
                            [
                                'attribute' => 'status',
                                'value' => $model->getStatusName(),
                            ],
                            [
                                'attribute' => 'short_description',
                                'format' => 'html',
                                'value' => $model->short_description
                            ],
                            [
                                'attribute' => 'content',
                                'visible' => $i_want_to_see_it ? true : false,
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'price',
                                'visible' => $i_want_to_see_it ? true : false,
                                'format' => 'raw',
                                'value'=>$model->price?News::formatNumber($model->price).' VND':''
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
</div>



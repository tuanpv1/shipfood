<?php
use common\models\Product;
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>
<div class="tabbable-custom ">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            [
                'attribute' => 'status',
                'value' => $model->getStatusName(),
            ],
            'short_description',
            'content:html',
        ],
    ]) ?>
</div>
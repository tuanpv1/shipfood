<?php
/**
 * Created by PhpStorm.
 * User: TuanPV
 * Date: 10/21/2017
 * Time: 9:33 AM
 */
/** @var  \common\models\News $model  */
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h5 class="modal-title" id="myModalLabel"><?= $model->title ?></h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-5">
            <img style="height: 300px" src="<?= $model->getImageLink() ?>" alt="<?= $model->title ?>"/>
        </div>
        <div class="col-md-7">
            <b>Giá thành:</b> <?= \common\models\News::formatNumber($model->price) ?> VND.
            <br>
            <?= $model->description ?>
            <br>
        </div>
    </div>
    <hr>
    <div style="width: 100%" class="container">
        <?= $model->content ?>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: TuanPV
 * Date: 8/7/2017
 * Time: 8:53 PM
 */
use common\models\News;
use yii\helpers\Url;

?>
<div class="col-md-3">
    <h5>Thực phẩm sạch</h5>
    <div class="list-food">
        <?php if ($listFood) {
            foreach ($listFood as $item) {
                /** @var News $item */
                ?>
                <div class="row" style="padding-top: 20px">
                    <div class="col-md-4 col-xs-3">
                        <a href="<?= Url::to(['site/detail-news', 'id' => $item->id]) ?>">
                            <img style="width: 80px" src="<?= $item->getImageLink() ?>"
                                 alt="<?= $item->title ?>" title="<?= $item->title ?>">
                        </a>
                    </div>
                    <div class="col-md-8 col-xs-9">
                        <a href="<?= Url::to(['site/detail-news', 'id' => $item->id]) ?>"><?= $item->title ?> - <?= News::formatNumber($item->price) ?> VND</a>
                    </div>
                </div>
                <?php
            }
        } ?>
    </div>
    <br>
    <h5>Đồ ăn & Thức uống</h5>
    <div class="list-food">
        <div class="row" style="padding-top: 20px">
        <?php if ($listDrink) {
            foreach ($listDrink as $item) {
                /** @var News $item */
                ?>
                    <div class="col-md-4 col-sm-4 col-xs-4" style="margin-bottom: 10px">
                        <a href="#">
                            <img style="width: 80px;height: 80px"  src="<?= $item->getImageLink() ?>"
                                 alt="<?= $item->title ?>" title="<?= $item->title ?>">
                        </a>
                    </div>
                <?php
            }
        }
        ?>
        </div>
    </div>
</div>

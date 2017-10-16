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
    <h4>Top đồ ăn ưa chuộng</h4>
    <div class="list-food">
        <?php if ($listFood) {
            foreach ($listFood as $item) {
                /** @var News $item */
                ?>
                <div class="row" style="padding-top: 20px">
                    <div class="col-md-4">
                        <a href="<?= Url::to(['site/detail-news', 'id' => $item->id]) ?>">
                            <img style="width: 80px" src="<?= News::getFirstImageLinkTP($item->images) ?>"
                                 alt="<?= $item->title ?>" title="<?= $item->title ?>">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <a href="<?= Url::to(['site/detail-news', 'id' => $item->id]) ?>"><?= $item->title ?></a>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="row" style="padding-top: 20px">
                <div class="col-md-4">
                    <a href="#">
                        <img style="width: 80px" src="images/p1.png"
                             alt="#" title="#">
                    </a>
                </div>
                <div class="col-md-8">
                    <a href="#"><h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6></a>
                </div>
            </div>
            <div class="row" style="padding-top: 20px">
                <div class="col-md-4">
                    <a href="#">
                        <img style="width: 80px" src="images/p1.png"
                             alt="#" title="#">
                    </a>
                </div>
                <div class="col-md-8">
                    <a href="#"><h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6></a>
                </div>
            </div>
            <div class="row" style="padding-top: 20px">
                <div class="col-md-4">
                    <a href="#">
                        <img style="width: 80px" src="images/p1.png"
                             alt="#" title="#">
                    </a>
                </div>
                <div class="col-md-8">
                    <a href="#"><h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6></a>
                </div>
            </div>
            <div class="row" style="padding-top: 20px">
                <div class="col-md-4">
                    <a href="#">
                        <img style="width: 80px" src="images/p1.png"
                             alt="#" title="#">
                    </a>
                </div>
                <div class="col-md-8">
                    <a href="#"><h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6></a>
                </div>
            </div>
            <?php
        } ?>
    </div>
    <br>
    <h4>Top đồ uống ưa chuộng</h4>
    <div class="list-food">
        <?php if ($listDrink) {
            foreach ($listDrink as $item) {
                /** @var News $item */
                ?>
                <div class="row" style="padding-top: 20px">
                    <div class="col-md-4">
                        <a href="<?= Url::to(['site/detail-news', 'id' => $item->id]) ?>">
                            <img style="width: 80px" src="<?= News::getFirstImageLinkTP($item->images) ?>"
                                 alt="<?= $item->title ?>" title="<?= $item->title ?>">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <a href="<?= Url::to(['site/detail-news', 'id' => $item->id]) ?>"><?= $item->title ?></a>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="row" style="padding-top: 20px">
                <div class="col-md-4">
                    <a href="#">
                        <img style="width: 80px" src="images/p1.png"
                             alt="#" title="#">
                    </a>
                </div>
                <div class="col-md-8">
                    <a href="#"><h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6></a>
                </div>
            </div>
            <div class="row" style="padding-top: 20px">
                <div class="col-md-4">
                    <a href="#">
                        <img style="width: 80px" src="images/p1.png"
                             alt="#" title="#">
                    </a>
                </div>
                <div class="col-md-8">
                    <a href="#"><h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6></a>
                </div>
            </div>
            <div class="row" style="padding-top: 20px">
                <div class="col-md-4">
                    <a href="#">
                        <img style="width: 80px" src="images/p1.png"
                             alt="#" title="#">
                    </a>
                </div>
                <div class="col-md-8">
                    <a href="#"><h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6></a>
                </div>
            </div>
            <?php
        } ?>
    </div>
</div>

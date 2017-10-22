<?php
use common\models\InfoPublic;
use common\models\News;
use yii\helpers\Json;
use yii\helpers\Url;

/** @var $info InfoPublic */
/** @var $gioithieu News */

?>
<section id="slider" class="slider">
    <div class="slider_overlay">
        <div class="container">
            <div class="row">
                <div class="main_slider text-center">
                    <div class="col-md-12">
                        <div class="main_slider_content wow zoomIn" data-wow-duration="1s">
                            <h1><?= $info->image_footer ?></h1>
                            <p><?= $info->image_menu ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section id="abouts" class="abouts">
    <div class="container">
        <div class="row">
            <div class="abouts_content">
                <div class="col-md-6">
                    <div class="single_abouts_text text-center wow slideInLeft" data-wow-duration="1s">
                        <img src="images/ab.png" alt=""/>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="single_abouts_text wow slideInRight" data-wow-duration="1s">
                        <h4>Shipfood</h4>
                        <h3><?= $gioithieu ? $gioithieu->title: "Chất Lượng - An Toàn - Vệ Sinh" ?></h3>
                        <p><?= $gioithieu->short_description ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="features" class="features">
    <div class="slider_overlay">
        <div class="container">
            <div class="row">
                <div class="main_features_content_area  wow fadeIn" data-wow-duration="3s">
                    <div class="col-md-12">
                        <div class="main_features_content text-left">
                            <div class="col-md-6">
                                <div class="single_features_text">
                                    <h4>Món ăn thương hiệu</h4>
                                    <h3>Bò xào kiểu nhật</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's stan</p>
                                    <p>dard dummy text ever since the 1500s,when an unknown printer took a galley of
                                        type and scrambled it to make a type specimen book. It has survived not only
                                        five centuries, but also the leap into electronic typesettingdard dummy text
                                        ever since the 1500s,when an unknown printer took a galley of type and scrambled
                                        it to make a type specimen book. It has survived not only five centuries, but
                                        also the leap into electronic typesetting</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="food" class="portfolio">
    <div class="container">
        <div class="row">
            <div class="portfolio_content text-center  wow fadeIn" data-wow-duration="5s">
                <div class="col-md-12">
                    <div class="head_title text-center">
                        <h4>Bữa ăn</h4>
                        <a href="<?= Url::home() ?>#food"
                           onclick="showFoodByCat(false,<?= News::TYPE_FOOD_MORNING ?>,<?= News::TYPE_FOOD_LUNCH ?>)">Tất
                            cả</a>
                        <a href="<?= Url::home() ?>#food"
                           onclick="showFoodByCat(true,<?= News::TYPE_FOOD_MORNING ?>,<?= News::TYPE_FOOD_LUNCH ?>)">Bữa
                            sáng</a>
                        <a href="<?= Url::home() ?>#food"
                           onclick="showFoodByCat(true,<?= News::TYPE_FOOD_LUNCH ?>,<?= News::TYPE_FOOD_MORNING ?>)">Bữa
                            trưa</a>
                    </div>

                    <div class="main_portfolio_content">
                        <?php
                        if ($listFood) {
                            foreach ($listFood as $food) {
                                /** @var $food News */
                                ?>
                                <div class="col-md-3 col-sm-4 col-xs-6 single_portfolio_text item_cat_<?= $food->type ?>">
                                    <img src="<?= $food->getImageLink() ?>" alt=""/>
                                    <div class="portfolio_images_overlay text-center">
                                        <h6><?= $food->title ?></h6>
                                        <p class="product_price"><?= News::formatNumber($food->price) ?> VND</p>
                                        <p class="product_info">
                                            <?= str_replace(".","<br>",$food->short_description) ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="drinks" class="ourPakeg">
    <div class="container">
        <div class="main_pakeg_content">
            <div class="row">
                <div class="single_pakeg_one text-right wow rotateInDownRight">
                    <div class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4">
                        <div class="single_pakeg_text">
                            <div class="pakeg_title">
                                <h4>Đồ Uống Kèm</h4>
                            </div>

                            <ul>
                                <?php
                                if ($listDrink) {
                                    foreach ($listDrink as $drink) {
                                        /** @var $drink News */
                                        ?>
                                        <li><img style="height: 100px;width: 100px" src="<?= $drink->getImageLink()?>" alt="">
                                            <?= ucfirst($drink->title) ?><?= $drink->getPoint() ?><?= News::formatNumber($drink->price) ?>
                                            VND
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="vegetable" class="portfolio">
    <div class="container">
        <div class="row">
            <div class="portfolio_content text-center  wow fadeIn" data-wow-duration="5s">
                <div class="col-md-12">
                    <div class="head_title text-center">
                        <h4>Từ nông trại đến bàn ăn</h4>
                        <a href="<?= Url::home() ?>#vegetable"
                           onclick="showVegetableByCat(false,<?= News::TYPE_VEGETABLES_SX ?>,<?= News::TYPE_VEGETABLES_LK ?>)">
                            Tất cả
                        </a>
                        <a href="<?= Url::home() ?>#vegetable"
                           onclick="showVegetableByCat(true,<?= News::TYPE_VEGETABLES_SX ?>,<?= News::TYPE_VEGETABLES_LK ?>)">
                            <?= News::getTypeName(News::TYPE_VEGETABLES_SX) ?>
                        </a>
                        <a href="<?= Url::home() ?>#vegetable"
                           onclick="showVegetableByCat(true,<?= News::TYPE_VEGETABLES_LK ?>,<?= News::TYPE_VEGETABLES_SX ?>)">
                            <?= News::getTypeName(News::TYPE_VEGETABLES_LK) ?>
                        </a>
                    </div>

                    <div class="main_portfolio_content">
                        <?php
                        if ($listVegetable) {
                            foreach ($listVegetable as $vegetable) {
                                /** @var $vegetable News */
                                ?>
                                <div class="col-md-3 col-sm-4 col-xs-6 single_portfolio_text item_cat_<?= $vegetable->type ?>">
                                    <img class="ship-img" src="<?= $vegetable->getImageLink() ?>"
                                         title="<?= $vegetable->title ?>" alt="<?= $vegetable->title ?>"/>
                                    <div class="portfolio_images_overlay text-center">
                                        <a href="<?= Url::home() ?>#vegetable" onclick="showModalDetail(<?= $vegetable->id ?>)">
                                            <h6><?= $vegetable->title ?></h6>
                                            <p class="product_price"><?= News::formatNumber($vegetable->price) ?>
                                                VND</p>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="mobaileapps" class="mobailapps">
    <div class="slider_overlay">
        <div class="container">
            <div class="row">
                <div class="main_mobail_apps_content wow zoomIn">
                    <div class="col-md-5 col-sm-12 text-center">
                        <img src="images/iphone.png" alt=""/>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <div class="single_monail_apps_text">
                            <h4> Dễ dàng hơn bao giờ hết </h4>
                            <h1>Mobile App <span>hỗ trợ trên các hệ điều hành.</span></h1>
                            <div class="col-md-6 col-sm-12 text-center">
                                <img style="width: 200px" src="<?= InfoPublic::getImage($info->image_android) ?>" alt=""/><br>
                                <a href="<?= $info->link_android ?>">
                                    <img src="images/google.png" alt=""/>
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-12 text-center">
                                <img style="width: 200px" src="<?= InfoPublic::getImage($info->image_ios) ?>" alt=""/><br>
                                <a href="<?= $info->link_ios ?>">
                                    <img src="images/apps.png" alt=""/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
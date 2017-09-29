<?php

/* @var $this yii\web\View */

use common\helpers\CUtils;
use common\models\Banner;
use common\models\News;
use yii\helpers\Url;

$this->title = 'Công ty Monalisa Spa';
?>
<!-- Begin #carousel-section -->
<section id="carousel-section" class="section-global-wrapper">
    <div class="container-fluid-kamn">
        <div class="row">
            <div id="carousel-1" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ol class="carousel-indicators visible-lg">
                    <?php if ($listBanner) {
                        $i = 0;
                        foreach ($listBanner as $item) { ?>
                            <li data-target="#carousel-1" data-slide-to="<?= $i ?>"
                                class="<?= $i == 0 ? 'active' : '' ?>"></li>
                            <?php
                            $i++;
                        }
                    } ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <?php if ($listBanner) {
                        $i = 0;
                        foreach ($listBanner as $item) {
                            /** @var Banner $item */ ?>
                            <!-- Begin Slide -->
                            <div class="text-center item <?= $i == 0 ? 'active' : '' ?>">
                                <img src="<?= $item->getImageLink() ?>" height="400" alt="<?= $item->name ?>">
                                <div class="carousel-caption">
                                    <h3 class="carousel-title hidden-xs"><?= $item->name ?></h3>
                                    <p class="carousel-body"><?= $item->des ?></p>
                                </div>
                            </div>
                            <!-- End Slide -->
                            <?php
                            $i++;
                        }
                    } ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-1" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-1" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- End #carousel-section -->

<?php if ($gioithieu) {
    /** @var News $gioithieu */ ?>
    <!-- Begin #services-section -->
    <section class="services-section section-global-wrapper">
        <div class="container">
            <div class="row">
                <div class="services-header">
                    <h1 class="services-header-title"><a title="<?= $gioithieu->title ?>" href="<?= Url::to(['site/detail-news','id'=>$gioithieu->id]) ?>"><?= $gioithieu->title ?></a></h1>
                </div>
            </div>

            <!-- Begin Services Row 1 -->
            <div class="row services-row services-row-head services-row-1">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <a href="<?= Url::to(['site/detail-news','id'=>$gioithieu->id]) ?>" title="<?= $gioithieu->title ?>">
                    <img width="300px" src="<?= News::getFirstImageLinkTP($gioithieu->images) ?>"
                         alt="<?= $gioithieu->title ?>" title="<?= $gioithieu->title ?>">
                    </a>
                </div>

                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <p class="text-left">
                        <?= $gioithieu->short_description ?>
                    </p>
                </div>
            </div>
            <!-- End Serivces Row 1 -->
        </div>
    </section>
    <!-- End #services-section -->
<?php } ?>

<!--partner block-->
<div class="container">
    <ul class="bxslider3 text-center">
        <?php if ($listDv) {
            foreach ($listDv as $item) {
                /** @var News $item */
                ?>
                <li>
                    <a href="<?= Url::to(['site/detail-news', 'id' => $item->id]) ?>">
                        <img style="height: 150px" src="<?= News::getFirstImageLinkTP($item->images) ?>"
                             alt="<?= $item->title ?>" >
                        <div style="padding-top: 10px" class="text-center"><?=  $item->title ?></div>
                    </a>
                </li>
                <?php
            }
        } ?>
    </ul>
</div>
<!--end partner-->

<!--Cong nghe-->
<section id="services" class="services-section section-global-wrapper">
    <div class="container">
        <div class="row">
            <div class="services-header">
                <h2 class="services-header-title">CÔNG NGHỆ ĐI ĐẦU TRONG LĨNH VỰC LÀM ĐẸP</h2>
            </div>
        </div>

        <!-- Begin Services Row 1 -->
        <div class="row services-row services-row-head services-row-1">
            <?php if ($listCn) {
                foreach ($listCn as $item) {
                    /** @var  News $item */
                    ?>
                    <div class="col-sm-4 col-md-3">
                        <div class="thumbnail">
                            <a href="<?= Url::to(['site/detail-news','id'=>$item->id]) ?>">
                            <img style="height: 200px" src="<?= News::getFirstImageLinkTP($item->images) ?>" alt="<?= $item->title ?>" >
                            </a>
                            <div class="caption">
                                <h4><a href="<?= Url::to(['site/detail-news','id'=>$item->id]) ?>"><?= $item->title ?></a></h4>
                                <p><?= CUtils::subString($item->short_description,130) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } ?>
        </div>
        <!-- End Serivces Row 1 -->
    </div>
</section>
<!--End cong nghe-->

<?= \frontend\widgets\Customers::widget() ?>

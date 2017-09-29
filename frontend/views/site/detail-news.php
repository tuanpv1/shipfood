<?php
/**
 * Created by PhpStorm.
 * User: TuanPV
 * Date: 8/7/2017
 * Time: 2:25 PM
 */
use common\models\News;
use frontend\widgets\Header;

if ($new) {
    $this->title = $new->title;
    /** @var News $new */
    ?>
    <div class="row container-kamn">
        <img src="<?= Yii::$app->getUrlManager()->getBaseUrl(); ?>/img/slider/slide5.jpg" class="blog-post"
             alt="Feature-img" align="right" width="100%">
    </div>
    <div id="banners"></div>
    <div class="container">
        <div class="col-md-9">
            <h1 class="text-center">
                <?= News::getTypeName($new->type) . " Monalisa Spa" ?>
            </h1>
            <div class="blog-post">
                <div class="row">
                    <div class="services-header">
                        <h2 class="services-header-title"><a href=""><?= $new->title ?></a></h2>
                    </div>
                </div>

                <!-- Begin Services Row 1 -->
                <div class="row services-row services-row-head services-row-1">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <img height="200px" src="<?= News::getFirstImageLinkTP($new->images) ?>"
                             alt="<?= $new->title ?>" title="<?= $new->title ?>">
                    </div>

                    <div style="padding-top: 15px" class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <i class="glyphicon glyphicon-eye-open"></i> Xem: <?= $new->view_count ?> &nbsp;
                        <i class="glyphicon glyphicon-time"></i> Ngày đăng: <?= date('d-m-Y', $new->created_at) ?><br>
                        <p style="padding-top: 15px"><?= $new->short_description ?></p>
                    </div>

                    <div class="col-xs-12">
                        <?php if ($new->type != News::TYPE_NEWS && $new->type != News::TYPE_ABOUT) { ?>
                            <hr>
                            <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:460px;margin:0px auto 56px;">
                                <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
                                    <ul class="amazingslider-slides" style="display:none;">
                                        <?php
                                        $img = $new->getImagesNews();
                                        if ($img) {
                                            foreach ($img as $item) {
                                                ?>
                                                <li>
                                                    <img src="<?= News::getImageFe($item->name) ?>"
                                                         title="<?= $new->title ?>" alt="<?= $new->title ?>"/>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <ul class="amazingslider-thumbnails" style="display:none;">
                                        <?php
                                        $img = $new->getImagesNews();
                                        if ($img) {
                                            foreach ($img as $item) {
                                                ?>
                                                <li>
                                                    <img id="product_image" alt="<?= $new->title ?>"
                                                         title="<?= $new->title ?>"
                                                         src="<?= News::getImageFe($item->name) ?>"/>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                        <?php }
                        if($new->type == News::TYPE_DV){ ?>
                            <p>Giá: <?= $new->price?News::formatNumber($new->price):0 ?> VND</p>
                            <p>Thời gian sử dụng dich vụ: <?= $new->honor?$new->honor.' Phút':'Liên hệ để biết chi tiết' ?> </p>
                        <?php }?>
                        <?= $new->content ?>
                    </div>
                </div>
                <!-- End Serivces Row 1 -->
            </div>
        </div>
        <?= Header::actiongMenuRight($new->type) ?>
    </div>
    <hr>
    <?php
} else {
    ?>
    <h1>Không tìm thấy nội dung </h1>
    <?php
}
?>
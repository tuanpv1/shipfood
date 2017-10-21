<?php
use common\models\InfoPublic;
use common\models\News;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $info InfoPublic */
?>
<div class='preloader'>
    <div class='loaded'>&nbsp;</div>
</div>
<header id="home" class="navbar-fixed-top">
    <div class="header_top_menu clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-md-offset-3 col-sm-12 text-right">
                    <div class="call_us_text">
                        <a href=""><i class="fa fa-clock-o"></i> Đặt hàng 24/7</a>
                        <a href=""><i class="fa fa-phone"></i><?= $info->phone ?></a>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="head_top_social text-right">
                        <a href="<?= $info->link_face ?>"><i class="fa fa-facebook"></i></a>
                        <a href="<?= $info->twitter ?>"><i class="fa fa-twitter"></i></a>
                        <a href="<?= $info->youtube ?>"><i class="fa fa-youtube"></i></a>
                        <a href="<?= $info->phone ?>"><i class="fa fa-phone"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- End navbar-collapse-->

    <div class="main_menu_bg">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand our_logo" href="<?= Url::home() ?>">
                                <img style="width: 110px" src="<?= $info->getImageLink() ?>"
                                     alt="<?= $info->image_footer ?>"/>
                            </a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?= Url::home() ?>#slider">Trang chủ</a></li>
                                <li><a href="<?= Url::home() ?>#abouts">Giới thiệu</a></li>
                                <li><a href="<?= Url::home() ?>#food">Thực đơn</a>
                                    <ul>
                                        <li><a href="<?= Url::home() ?>#food">Đồ ăn</a></li>
                                        <li><a href="<?= Url::home() ?>#drinks">Đồ uống</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?= Url::home() ?>#vegetable"
                                       onclick="showVegetableByCat(false,<?= News::TYPE_VEGETABLES_SX ?>,<?= News::TYPE_VEGETABLES_LK ?>)">Thực phẩm</a>
                                    <ul>
                                        <li>
                                            <a href="<?= Url::home() ?>#vegetable"
                                               onclick="showVegetableByCat(true,<?= News::TYPE_VEGETABLES_SX ?>,<?= News::TYPE_VEGETABLES_LK ?>)">
                                                <?= News::getTypeName(News::TYPE_VEGETABLES_SX) ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::home() ?>#vegetable"
                                               onclick="showVegetableByCat(true,<?= News::TYPE_VEGETABLES_LK ?>,<?= News::TYPE_VEGETABLES_SX ?>)">
                                                <?= News::getTypeName(News::TYPE_VEGETABLES_LK) ?>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="<?= Url::to(['site/news']) ?>">Tin tức</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#myModal">Tuyển Dụng</a></li>
                                <li><a href="<?= Url::home() ?>#mobaileapps">Tải app</a></li>
                                <li><a href="<?= Url::home() ?>#footer">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="myModalLabel">Điền thông tin cá nhân </h5>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'form-signup',
                    'action' => Url::to(['site/book']),
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>

                <?= $form->field($model, 'full_name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'phone')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'position')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'address')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'id_dv')->dropDownList(\common\models\Book::listShift()) ?>

                <?= $form->field($model, 'file')->fileInput() ?>

                <div class="form-group text-center">
                    <?= Html::submitButton('Hoàn thành', ['class' => 'btn btn-danger', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
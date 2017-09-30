<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Footer;
use frontend\widgets\Header;
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name='viewport' content="width=device-width, initial-scale=1">
    <meta name='generator' content="designwebsitett.vn" />
    <meta name='copyright' content="Công ty cổ phần thiết kế T&T" />
    <meta name='author' content="designwebsitett.vn" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="home blog">
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=147612099135213";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<?= Header::widget([]) ?>
<?= $content ?>
<?= Footer::widget([]) ?>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>

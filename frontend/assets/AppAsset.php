<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/isotope.css',
        'js/fancybox/jquery.fancybox.css',
        'css/animate.css',
        'js/owl-carousel/owl.carousel.css',
        'font/css/font-awesome.min.css',
        'css/jquery.bxslider.css',
        'css/styles.css',
    ];
    public $js = [
        'js/modernizr-latest.js',
        'js/jquery-1.8.2.min.js',
        'js/bootstrap.min.js',
        'js/jquery.isotope.min.js',
        'js/fancybox/jquery.fancybox.pack.js',
        'js/jquery.nav.js',
        'js/jquery.fittext.js',
        'js/waypoints.js',
        'js/owl-carousel/owl.carousel.js',
        'js/jquery.bxslider.min.js',
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}

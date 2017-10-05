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
        'https://fonts.googleapis.com/css?family=Pacifico',
        'css/font-awesome.min.css',
        'css/animate/animate.css',
        'css/plugins.css',
        'css/style.css',
        'css/responsive.css',
    ];
    public $js = [
        'js/vendor/jquery-1.11.2.min.js',
        'js/vendor/bootstrap.min.js',
        'js/vendor/modernizr-2.8.3-respond-1.4.2.min.js',
        'js/jquery-easing/jquery.easing.1.3.js',
        'js/wow/wow.min.js',
        'js/plugins.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}

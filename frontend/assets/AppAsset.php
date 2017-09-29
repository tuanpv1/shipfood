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
        'http://fonts.googleapis.com/css?family=Open+Sans:400,300',
        'http://fonts.googleapis.com/css?family=PT+Sans',
        'http://fonts.googleapis.com/css?family=Raleway',
        'https://fonts.googleapis.com/css?family=Roboto:400,700',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        'bootstrap/css/bootstrap.css',
        'css/bootstrap-datetimepicker.min.css',
        'css/font-awesome.min.css',
        'css/style.css',
        'css/animate.min.css',
        'css/style-projects.css',
        'css/jquery.bxslider.css',
        'sliderengine/amazingslider-1.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'bootstrap/js/bootstrap.min.js',
        'js/wow.min.js',
        'js/jquery.bxslider.min.js',
        'js/bootstrap-datetimepicker.js',
        'js/bootstrap-datetimepicker.es.js',
        'sliderengine/amazingslider.js',
        'sliderengine/initslider-1.js',
        'js/tp.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}

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
        'css/site.css',
        'css/amazeui.min.css',
        'css/petshow.css',
        'css/animate.min.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/amazeui.min.js',
        'js/countUp.min.js',
        'js/amazeui.lazyload.min.js',
        'js/petshow.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

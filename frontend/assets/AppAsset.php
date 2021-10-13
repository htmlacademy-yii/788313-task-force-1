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
        'css/normalize.css',
        'css/style.css',
    ];
    public $js = [
        'js/dropzone.js',
        'js/messenger.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        /*'yii\bootstrap\BootstrapAsset',*/
    ];
}

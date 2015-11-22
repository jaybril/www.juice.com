<?php
namespace frontend\assets;
use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/com.css',
        'css/ext.css',
//        'css/orc.css',
//        'css/index.css',
//        'css/new.css',
//        'css/pro.css',
//        'css/orc.css',
//        'css/at.css',
//        'css/serve.css',
//        'css/life.css',
//        'css/busines.css',
//        'css/join.css',
    ];
    public $js = [
        'js/jquery/jquery.min.js',
        'js/jquery/roundabout/jquery.roundabout.js',
        'js/jquery/roundabout/jquery.roundabout-shapes.js',
        'layer/layer.js',
        'js/global.js',
//        'js/index.js',
//        'js/pro.js',
//        'js/orc.js',
//        'js/at.js',
//        'js/join.js',
    ];

    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

    //定义按需加载JS方法，注意加载顺序在最后
    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'frontend\assets\AppAsset']);
    }

    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'frontend\assets\AppAsset']);
    }

}

<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/admin.css',
        'css/adminpage.css',
        'css/comment.css',
        'css/index.css',
        'css/otherpage.css',
        'css/reset.css',
        'css/site.css',
        'css/jcarousel.connected-carousels.css'
    ];
    public $js = [
        'js/jquery-ui.js',
        'js/admin.js',
        'js/html5.js',
        'js/selectivizr.js',
        'layer/layer.js',
        'js/jcarousel.connected-carousels.js',
        'js/jquery.jcarousel.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',

    ];
}

<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PanelAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    // public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $css = [
        'jquery-ui/jquery-ui.min.css',
        'css/lightbox.min.css',
        'css/fancybox.css',
        'css/materialize.min.css',
        'css/main.css',
        'css/panel.css',
    ];
    public $js = [
        'js/jquery-3.7.1.min.js',
        'jquery-ui/jquery-ui.min.js',
        'js/lightbox.min.js',
        'js/fancybox.umd.js',
        'js/moment.js',
        'js/moment-timezone.js',
        'js/swal.js',
        'js/materialize.min.js',
        'dt/datatables.min.js',
        'js/utils/wilayah.js',
        'js/utils/puller.js',
        'js/main.js',
        'js/panel.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
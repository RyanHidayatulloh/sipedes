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
    public $css = [
        'dt/datatables.min.css',
        'css/materialize.min.css',
        'css/main.css',
        'css/landing.css',
    ];
    public $js = [
        'js/jquery-3.7.1.min.js',
        'js/swal.js',
        'dt/datatables.min.js',
        'js/materialize.min.js',
        'js/main.js',
        'js/panel.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
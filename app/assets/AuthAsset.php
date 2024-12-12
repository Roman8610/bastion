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
class AuthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback",
        "adminlte/plugins/fontawesome-free/css/all.min.css",
        "adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css",
        "adminlte/dist/css/adminlte.min.css",
    ];
    public $js = [
        "adminlte/plugins/jquery/jquery.min.js",
        "adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js",
        "adminlte/dist/js/adminlte.min.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap5\BootstrapAsset'
    ];
}
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
class BastionAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'https://fonts.googleapis.com/css2?family=Manrope:wght@700&amp;family=Montserrat:wght@500;600;700&amp;display=swap',
        'css/main.min.css',
        //'css/main.css',
        //'css/manufacture.css',
		'css/user.css',
    ];
    public $js = [
        'js/main.js',
        'js/main.min.js',
        'js/manifest.js',
        'js/vendor.js',
        //'https://www.google.com/recaptcha/api.js',
        'https://www.google.com/recaptcha/api.js?render=6LehPsMqAAAAAIgE1kjRsjrCQFImNgMAUvV086KP',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap5\BootstrapAsset'
    ];
}
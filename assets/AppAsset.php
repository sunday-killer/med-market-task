<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'css/site.css',
    ];
    public $js = [
      "//cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js",
    ];
    public $depends = [
      'app\assets\FontAwesomeAsset',
      'yii\web\YiiAsset',
      'yii\bootstrap4\BootstrapAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}

<?php

namespace backend\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/min/style.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap5\BootstrapAsset',
    ];

    public function init()
    {
        parent::init();
        Yii::$app->assetManager->bundles['yii\bootstrap5\BootstrapAsset'] = [
            'css' => [],
            'js' => []
        ];
    }
}

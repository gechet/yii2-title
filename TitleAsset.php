<?php

namespace gechet\title;

use yii\web\AssetBundle;

/**
 * Debugger asset bundle
 *
 * @author Serhii Chepela <scheoriginal@gmail.com>
 */
class TitleAsset extends AssetBundle
{
    public $sourcePath = '@gechet/title/assets';
    public $css = [
        'main.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

<?php

namespace app\assets;

use yii\web\AssetBundle;

class SchalpoenAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/scss';
    public $css = [
        'schalpoen.scss',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        FontAsset::class,
    ];
}

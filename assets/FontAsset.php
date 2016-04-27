<?php
namespace app\assets;

use yii\web\AssetBundle;

class FontAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Shanti',
        '//fonts.googleapis.com/css?family=Open+Sans',
    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
}

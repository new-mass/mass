<?php


namespace frontend\assets;

use yii\web\AssetBundle;

class OwlAsset extends AssetBundle
{
    public $sourcePath = '@bower/owl-carousel2';
    public $css = [
        'dist/assets/owl.carousel.css',
    ];

    public $js = [
        'dist/owl.carousel.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
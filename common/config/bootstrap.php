<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

function dd($param = ''){
    echo '<pre>';

    var_dump($param);

    echo '</pre>';

    die();
}
function d($param = ''){
    echo '<pre>';

    var_dump($param);

    echo '</pre>';
}

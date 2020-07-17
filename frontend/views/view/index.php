<?php

/* @var $this \yii\web\View */
/* @var $posts array */
/* @var $meta array */

echo $this->renderFile('@app/views/site/index.php', [
    'posts' => $posts,
    'meta' => $meta,
] );
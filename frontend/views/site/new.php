<?php
/* @var $posts array */

foreach ($posts as $item){

    echo $this->renderFile(Yii::getAlias('@app/views/layouts/item.php'), [
        'item' => $item
    ]);

}
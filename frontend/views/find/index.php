<?php

/* @var $posts \frontend\modules\user\models\Posts[] */
/* @var $h1 string */
/* @var $this \yii\web\View */

$this->title = $h1;

echo '<div class="col-12"><h1 class="h1">' . $h1 . '</h1></div>';

if ($posts) {

    foreach ($posts as $item) {

        echo '<div class="col-6 col-lg-4 col-md-4 col-xl-3 article-item">';

        echo $this->renderFile(Yii::getAlias('@app/views/layouts/item.php'), [
            'item' => $item
        ]);

        echo '</div>';

    }

    echo '</div>';

}else echo '<div class="col-12">По Вашему запросу ничего не найдено, попробуйте изменить фильтр</div>';
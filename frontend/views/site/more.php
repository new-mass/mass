<?php
/* @var $posts array */
/* @var $pageUrl array */


echo '<div class="col-12">';
echo '<div class="row">';

echo '<div data-page-url="'.$pageUrl.'" class="col-12"></div>';

if ($posts) {

    foreach ($posts as $item){

        echo '<div class="col-6 col-lg-4 col-md-4 col-xl-3 article-item">';

            echo $this->renderFile(Yii::getAlias('@app/views/layouts/item.php'), [
                'item' => $item
            ]);

        echo '</div>';

    }

    echo '</div>';
    echo '</div>';
}
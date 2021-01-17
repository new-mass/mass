<?php

/* @var $this yii\web\View */
/* @var $posts array */
/* @var $more_posts array */
/* @var $meta array */
/* @var $pages array */
/* @var $tag array */

$this->title = $meta['title'];

$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta['des']
]);

if (isset($tag) and $tag){

    $this->registerMetaTag([
        'name' => 'yandex-verification',
        'content' => $tag['tag']
    ]);

}


echo '<div class="col-12">';
echo '<div class="row fisrst-content">';
echo '<div data-page-url="'.Yii::$app->request->url.'" class="col-12"></div>';

if ( $meta and !isset($main)) echo '<div class="col-12"><h1 class="h1">'.$meta['h1'].'</h1></div>';
echo '<div class="col-12" data-page-url="/"></div>';
if ($posts) {

    foreach ($posts as $item){

        echo '<div class="col-6 col-lg-4 col-md-4 col-xl-3 article-item">';

        echo $this->renderFile(Yii::getAlias('@app/views/layouts/item.php'), [
            'item' => $item
        ]);

        echo '</div>';

    }

    echo '</div>';
}
?>

    <div class="row">
        <div class="col-12">
            <?php

            if ($pages) echo \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
            ]);

            ?>
        </div>
    </div>

<?php

if ($more_posts) {

    echo '<div class="col-12">';

    echo '<div class="row fisrst-content popular-content">';

    echo '<div class="col-12">Популярные сейчас</div>';

    foreach ($more_posts as $item){

        echo '<div class="col-6 col-lg-4 col-md-4 col-xl-3 article-item">';

        echo $this->renderFile(Yii::getAlias('@app/views/layouts/item.php'), [
            'item' => $item
        ]);

        echo '</div>';

    }
}

echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

$limit = Yii::$app->params['post_limit'];

$url = $_SERVER['REQUEST_URI'];

$offset =  \frontend\components\helpers\PageHelper::PageOffsetHelper($url) * $limit ;

echo '<div class="row">';

    echo '<div class="col-12">';

        echo '<div onclick="getMorePosts(this)" data-limit="'.$limit.'" class="get-more-post-list" data-url="'.$url.'" data-offset="'.$offset.'"></div>';

    echo '</div>';

echo '</div>';

if ($meta['text'] and $meta['h2']){

    echo '<div class="container">';
    echo '<div class="row page-text">';

    echo '<div class="col-12 page-text-wrap">';

    echo '<h2 class="h1">'.$meta['h2'].'</h2>';

        echo $meta['text'];

    echo '</div>';

    echo '</div>';
    echo '</div>';

}

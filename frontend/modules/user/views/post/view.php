<?php

/* @var $post array */
/* @var $city array */
/* @var $this \yii\web\View */

use frontend\assets\OwlAsset;
use frontend\assets\LightGalleryAsset;
use frontend\components\MetaTagsHelper;


$this->title = MetaTagsHelper::singleTitle($post, $city);

$this->registerMetaTag([
    'name' => 'description',
    'content' => MetaTagsHelper::singleDes($post, $city)
]);

OwlAsset::register($this);
LightGalleryAsset::register($this);

?>
<div class="col-12" itemscope="" itemtype="http://schema.org/Product">

    <?php

        echo $this->renderFile(Yii::getAlias('@app/modules/user/views/post/post.php'), [
            'post' => $post,
        ]);

    ?>

    <div class="recomend">

    </div>

    <div class="row">
        <div class="col-12 "><h3 class="big-heading pop pop-heading">Популярные анкеты:</h3></div>
    </div>

    <div class="row">
        <div class="col-12 preload-single">
            <p>Загрузка анкеты...</p>
            <div class="container">
                <div class="dash uno"></div>
                <div class="dash dos"></div>
                <div class="dash tres"></div>
                <div class="dash cuatro"></div>
            </div>
        </div>
    </div>
</div>
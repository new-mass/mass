<?php

/* @var $post array */
/* @var $city array */
/* @var $this \yii\web\View */

use frontend\assets\LightGalleryAsset;
use frontend\components\MetaTagsHelper;

$this->title = MetaTagsHelper::singleTitle($post, $city);

$this->registerMetaTag([
    'name' => 'description',
    'content' => $des = MetaTagsHelper::singleDes($post, $city).' ID '.$post['id'].' номер '.$post['phone']
]);

$this->registerMetaTag([
    'name' => 'og:title',
    'content' => $this->title
]);

$this->registerMetaTag([
    'name' => 'og:description',
    'content' => $des
]);
$this->registerMetaTag([
    'name' => 'og:image',
    'content' => 'https://'.Yii::$app->request->hostName.$post['avatar']['file']
]);

$this->registerMetaTag([
    'name' => 'og:url',
    'content' => 'https://'.Yii::$app->request->hostName.Yii::$app->request->url
]);

LightGalleryAsset::register($this);

?>
<div class="col-12">

    <?php

        echo $this->renderFile(Yii::getAlias('@app/modules/user/views/post/post.php'), [
            'post' => $post,
        ]);

    ?>

    <div class="row">
        <div class="col-12 "><p class="big-heading pop pop-heading big-heading">Популярные анкеты:</p></div>
    </div>

    <div class="recomend">

    </div>

    <div class="row">
        <div class="col-12">
            <div class="get_more" onclick="get_recom_post();ym(50332519,'reachGoal','MORE_SINGLE');">Следующая анкета</div>
        </div>
    </div>

</div>
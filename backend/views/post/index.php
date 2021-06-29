<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($user) {
                    /* @var $user \app\models\Posts */
                    $user->getCity();
                    return Html::a($user['name'], 'http://'.$user['city']['name'].'.'.Yii::$app->params['site_name'] .'/anketa/'.$user['url'], ['width' => '50px', 'target' => 'blank']);

                },
            ],
            [
                'attribute' => 'picture',
                'format' => 'raw',
                'value' => function ($user) {
                    /* @var $user \app\models\Posts */
                    $user->getAvatar();
                    return Html::img('http://korolev.'.Yii::$app->params['site_name'] .$user['avatar']['file'], ['width' => '50px']);

                },
            ],
            //'phone',
            'age',
            'user_id',
            'price',
            //'price_2_hour',
            'about:ntext',
            'status',
            [
                'attribute' => 'Статус',
                'format' => 'raw',
                'value' => function ($post) {
                    /* @var $post \app\models\Posts */
                    if ($post['status'] == \app\models\Posts::POST_ON_MODERETION) {
                        return'<div class="check-post check-post-'.$post['id'].'" data-id="'.$post['id'].'" onclick="check_anket(this)">Подтвердить</div>';
                    }

                    if ($post['status'] == \app\models\Posts::POST_DONT_PUBLICATION) return 'Отключена';
                    if ($post['status'] == \app\models\Posts::POST_ON_PUBLICATION) return 'Включена';
                },
            ],

            ['class' => 'backend\components\ActionColumnExtends'],
        ],
    ]); ?>


</div>

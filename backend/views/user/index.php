<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            'status',
            [
                'attribute' => 'created_at',
                'format' => 'raw',
                'value' => function ($user) {
                    /* @var $user \common\models\User */
                    return date('Y-m-d H:i:s', $user->created_at);
                },
            ],
            'cash',
            'old_pass',
            [
                'attribute' => 'city_id',
                'format' => 'raw',
                'value' => function ($user) {
                    /* @var $user \common\models\User */
                    $user->getCity();
                    return $user['city']['value'];

                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

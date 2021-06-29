<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Check Photo Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-photo-request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Check Photo Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'post_id',
                'format' => 'raw',
                'value' => function ($item) {

                     /* @var $item \common\models\CheckPhotoRequest */

                    return Html::a($item->post_id, '/post/update?id='.$item->post_id, ['target' => '_blank']);

                }
            ],
            [
                'attribute' => 'created_at',
                'format' => 'raw',
                'value' => function ($item) {

                    /* @var $item \common\models\CheckPhotoRequest */

                    return date('Y-m-d H:i:s', $item->created_at);

                }
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'raw',
                'value' => function ($item) {

                    /* @var $item \common\models\CheckPhotoRequest */

                    return date('Y-m-d H:i:s', $item->updated_at);

                }
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($item) {

                    /* @var $item \common\models\CheckPhotoRequest */

                    switch ($item->status) {
                        case \common\models\CheckPhotoRequest::REQUEST_CHECK:
                            return 'Заявка проверенна';
                        case \common\models\CheckPhotoRequest::REQUEST_NOT_CHECK:
                            return 'Заявка не проверенна';

                    }

                    return date('Y-m-d H:i:s', $item->updated_at);

                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

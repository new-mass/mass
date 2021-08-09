<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anket Claims';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anket-claim-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Anket Claim', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'reason_id',
                'format' => 'raw',
                'value' => function($item){

                    /* @var $item \common\models\AnketClaim */

                    $item->getReason();

                    return $item['reason']['value'];

                }
            ],
            [
                'attribute' => 'post_id',
                'format' => 'raw',
                'value' => function($item){

                    /* @var $item \common\models\AnketClaim */

                    $item->getPost();

                    return Html::a($item['post']['name'], '/post/update?id='.$item['post']['id'], ['target' => '_blank']);

                }
            ],
            'text',
            'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

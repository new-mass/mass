<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Page Metas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-meta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Page Meta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'city_id',
                'format' => 'raw',
                'value' => function($item){

                    /* @var $item \frontend\models\PageMeta */

                    $item->getCity();

                    return $item['city']['value'];

                }
            ],
            'page_name',
            'title',
            'des',
            'h1',
            'h2',
            [
                'attribute' => 'text',
                'format' => 'raw',
                'value' => function($item){

                    /* @var $item \frontend\models\PageMeta */

                    return substr($item['text'], 0, 251);

                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

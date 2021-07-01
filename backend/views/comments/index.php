<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Comments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'parent_id',
            'post_id',
            'name',
            'text',

            'status',
            [
                'attribute' => 'created_at',
                'format' => 'raw',
                'value' => function($item){

                    /* @var $item \frontend\modules\user\models\Comments */

                    return date("Y-m-d H:i:s", $item->created_at);

                }
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'raw',
                'value' => function($item){

                    /* @var $item \frontend\modules\user\models\Comments */

                    return date("Y-m-d H:i:s", $item->updated_at);

                }
            ],
            [
                'attribute' => 'Одобрить',
                'format' => 'raw',
                'value' => function ($item) {

                    /* @var $item \frontend\modules\user\models\Comments */

                    if ($item->status == \frontend\modules\user\models\Comments::COMMENT_ON_MODERETION)

                    return Html::a('Одобрить', '#', ['data-id' => $item->id, 'onclick' => 'check_comments(this)']);

                    return 'Одобрено';

                },
            ],
            //'old_id',
            //'city_id',
            //'old_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

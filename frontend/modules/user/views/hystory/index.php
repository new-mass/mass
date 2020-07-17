<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\user\views\hystory */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile(Yii::getAlias('@web/css/cabinet.css'), ['depends' => [\frontend\assets\AppAsset::class]]);

$this->title = 'История';
?>
<div class="col-3">
    <?php echo \frontend\modules\user\widgets\UserSideBarWidget::widget() ?>
</div>
<div class="hystory-index col-9">

    <h1 class="h1"><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'type',
            'timestamp:datetime',
            'balance',
            'sum',
        ],
    ]); ?>


</div>

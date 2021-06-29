<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CheckPhotoRequest */

$this->title = 'Update Check Photo Request: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Check Photo Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="check-photo-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

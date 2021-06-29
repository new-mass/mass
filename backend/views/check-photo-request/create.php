<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CheckPhotoRequest */

$this->title = 'Create Check Photo Request';
$this->params['breadcrumbs'][] = ['label' => 'Check Photo Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-photo-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PageMeta */

$this->title = 'Update Page Meta: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Page Metas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-meta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

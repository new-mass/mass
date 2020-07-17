<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PostsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'city_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'tarif_id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'sorting') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'work_time') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'breast') ?>

    <?php // echo $form->field($model, 'ves') ?>

    <?php // echo $form->field($model, 'rost') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'price_2_hour') ?>

    <?php // echo $form->field($model, 'about') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'pay_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

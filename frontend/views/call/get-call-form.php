<?php

/* @var $callForm \common\models\RequestCall */

/* @var $id integer */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'claim-form',
    'action' => '/call/add',
    'options' => ['class' => 'form-horizontal'],
]) ?>
    <p class="modal-title margin-top-20" id="exampleModalLabel">Зказать звонок</p>

<?= $form->field($callForm, 'post_id')->hiddenInput(['value' => $id])->label(false) ?>

<?= $form->field($callForm, 'phone')->textInput()->label('Ваш номер') ?>

<?= $form->field($callForm, 'text')->textarea()->label('Комментарий') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'bbtn accent-btn-1 send-claim']) ?>
    </div>

<?php ActiveForm::end() ?>
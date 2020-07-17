<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $claimForm \frontend\models\forms\ClaimForm */

$form = ActiveForm::begin([
    'id' => 'login-form',
    'action' => '/claim/add',
    'options' => ['class' => 'form-horizontal'],
]) ?>
    <p class="regiter-text">Задать вопрос</p>
    <p class="regiter-text-slogan">Если Ваше обращения связано с анкетами просим указывать ссылку на эту анкету</p>
<?= $form->field($claimForm, 'name')->textInput(['placeholder' => 'Имя'])->label(false) ?>
<?= $form->field($claimForm, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>
<?= $form->field($claimForm, 'text')->textarea(['placeholder' => 'Сообщение'])->label(false) ?>

    </div>

    <div class="form-group">
        <div class="modal-footer claim-footer">
            <?= Html::submitButton('Отправить', ['class' => 'bbtn accent-btn-1 send-claim']) ?>
        </div>
    </div>

<?php ActiveForm::end();
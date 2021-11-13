<?php

/* @var $claimForm \frontend\modules\user\models\forms\AnketClaimForm */
/* @var $id integer */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'claim-form',
    'action' => '/claim/post/add',
    'options' => ['class' => 'form-horizontal'],
]) ?>
    <p class="modal-title margin-top-20" id="exampleModalLabel">Опишите Вашу проблему</p>
<?= $form->field($claimForm, 'post_id')->hiddenInput(['value' => $id])->label(false) ?>
<?= $form->field($claimForm, 'reason')
    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\ReasonClaim::find()->asArray()->all(), 'id', 'value'))
    ->label('Причина жалобы') ?>
<?= $form->field($claimForm, 'text')->textarea()->label('Комментарий') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'bbtn accent-btn-1 send-claim']) ?>
    </div>

<?php ActiveForm::end() ?>
<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $this \yii\web\View */
/* @var $modelSign \frontend\models\SignupForm */

$this->title = 'Войти в кабинет';

?>
<script src="//code.jivosite.com/widget/O6TixAAC9q" async></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<div class="col-md-6 col-sm-12">
    <div class="user_login_form">
        <div class="anket-heading"><p>Регистрация</p></div>
        <div class="signup-form">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'action' => '/cabinet/register']); ?>

            <?= $form->field($modelSign, 'username')->textInput(['placeholder' => 'Ваше имя'])->label(false) ?>

            <?= $form->field($modelSign, 'email')->textInput(['placeholder' => 'Ваш email'])->label(false) ?>

            <?= $form->field($modelSign, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>
            <div class="g-recaptcha" data-sitekey="6Led3OgUAAAAANsRaxNxoM2Ztp0FOB1czuflyHag"></div>
            <div class="form-group">
                <?= Html::submitButton('Регистрация', ['class' => 'btn accent-btn-1 register-btn', 'name' => 'signup-button', 'onclick' => "yaCounter50332519.reachGoal('REGITER');return true;"]) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

        <div class="vk-login">
            <div class="anket-heading"><p>Войти через</p></div>
            <?= yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['/site/auth'],
                'popupMode' => false,
            ]) ?>
        </div>


    </div>

</div>

<div class="col-md-6 col-sm-12 padding-right">

    <div class="user_login_form">

        <div class="anket-heading"><p>Авторизация</p></div>
        <div class="signup-form">
            <?php $form = ActiveForm::begin(['id' => 'form-login']); ?>

            <?= $form->field($model, 'email')->textInput(['placeholder' => 'Ваш email'])->label(false) ?>

            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Войти', ['class' => 'btn accent-btn-1 register-btn', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
    <br/>
    <br/>
</div>
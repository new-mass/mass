<?php
/* @var $this \yii\web\View */
/* @var $payForm \frontend\modules\user\models\forms\PayForm */
/* @var $items array */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->registerCssFile(Yii::getAlias('@web/css/cabinet.css'), ['depends' => [\frontend\assets\AppAsset::class]]);
$this->title = "Пополнить баланс";
?>
<script src="//code.jivosite.com/widget/O6TixAAC9q" async></script>
<div class="col-12 col-md-5 col-lg-4 col-xl-3">
    <?php echo \frontend\modules\user\widgets\UserSideBarWidget::widget() ?>
</div>
<div class="col-12 col-md-7 col-lg-8 col-xl-9">

        <div class="main-banner">
            <h1><?php echo $this->title ?></h1>

            <?php

            $form = ActiveForm::begin([
                'id' => 'pay-form',
                'options' => ['class' => 'form-horizontal'],
            ])

            ?>

            <?= $form->field($payForm, 'sum')->textInput(['value' => 200]) ?>

            <div class="form-group">

                <?= Html::submitButton('Пополнить', ['class' => 'btn accent-btn-1']) ?>

            </div>

            <?php ActiveForm::end() ?>

        </div>


</div>
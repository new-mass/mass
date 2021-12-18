<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\modules\user\models\City;

/* @var $this yii\web\View */
/* @var $model common\models\Link */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="link-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-4">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-4"><?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?></div>
        <div class="col-4"><?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?></div>
        <div class="col-4"><?= $form->field($model, 'city_id')
                ->dropDownList(ArrayHelper::map(City::find()->all(), 'id', 'value')) ?></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

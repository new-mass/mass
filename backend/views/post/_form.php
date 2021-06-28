<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\modules\user\models\Tarif;
use frontend\modules\user\models\Posts;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Имя') ?>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'tarif_id')
                ->dropDownList(ArrayHelper::map(Tarif::find()->asArray()->all(), 'id', 'name')) ?>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'status')
                ->dropDownList([
                        Posts::POST_ON_MODERETION => 'Анкета на модерации',
                        Posts::POST_ON_PUBLICATION => 'Анкета на публикации',
                        Posts::POST_DONT_PUBLICATION => 'Анкета не публикуется',
                ])
            ?>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'check_photo_status')
                ->dropDownList([
                        Posts::PHOTO_NOT_CHECK => 'Фото не подтверждено',
                        Posts::PHOTO_CHECK => 'Фото подтверждено',
                ])
            ?>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'work_time')->textInput() ?>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'age')->textInput() ?>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'breast')->textInput() ?>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'ves')->textInput() ?>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'rost')->textInput() ?>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'price_2_hour')->textInput() ?>
        </div>

        <div class="col-12">
            <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>
        </div>

        <div class="col-12 col-md-4">
            <p>Главное фото</p>
            <?php echo Html::img('http://korolev.' . Yii::$app->params['site_name'] . $model['avatar']['file']) ?>
        </div>
        <div class="col-12">

        </div>
        <div class="col-12 col-md-4">
            <p>Проверочное фото</p>
            <?php echo Html::img('http://korolev.' . Yii::$app->params['site_name'] . $model['checkPhoto']['file']) ?>
        </div>

        <div class="col-12">

        </div>

        <?php if ($model['video']['file']) : ?>

        <div class="col-12 col-md-4">
            <p>Видео</p>
            <?php echo Html::img('http://korolev.' . Yii::$app->params['site_name'] . $model['video']['file']) ?>
        </div>

        <div class="col-12">

        </div>
        <?php endif; ?>
        <div class="col-12">
            <p>Галерея</p>
            <div class="row">

                <?php foreach ($model['gallery'] as $item) : ?>

                    <div class="col-4 col-sm-3">
                        <?php echo Html::img('http://korolev.' . Yii::$app->params['site_name'] . $item['file']) ?>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>

        <div class="col-12">
            <strong>Добавлено: <?php echo date("Y-m-d H:i:s", $model->created_at)  ?></strong>
            <br>
            <strong>Обновлено: <?php echo date("Y-m-d H:i:s", $model->updated_at)  ?></strong>
        </div>

    </div>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

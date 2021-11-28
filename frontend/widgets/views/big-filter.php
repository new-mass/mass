<?php

/* @var $model \frontend\models\forms\FindModel */

/* @var $metro \frontend\modules\user\models\Metro */
/* @var $service \frontend\modules\user\models\Service */
/* @var $rayon \frontend\modules\user\models\Rayon */
/* @var $place \frontend\modules\user\models\Place */

/* @var $massagDlya \frontend\modules\user\models\MassagDlya */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<div class="filter">
    <div class="mobile-filter">

        <div class="open-filter-btn">
            <span>Развернуть фильтр поиска</span>
            <span class="hide-btn">Свернуть фильтр</span>
        </div>

        <div class="mobile-filter-content-wrap">

            <?php

            $form = ActiveForm::begin([
                'id' => 'filter-form',
                'action' => 'filter',
                'method' => 'get',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>

            <?php if ($metro) : ?>

                <?= $form->field($model, 'metro')
                    ->dropDownList(ArrayHelper::map($metro, 'id', 'value'))
                    ->label('Выбрать метро') ?>

            <?php elseif ($rayon) : ?>

                <?= $form->field($model, 'rayon')
                    ->dropDownList(ArrayHelper::map($rayon, 'id', 'value'))
                    ->label('Выбрать район') ?>

            <?php endif; ?>

            <?php if ($service) : ?>


                <?= $form->field($model, 'service')
                    ->dropDownList(ArrayHelper::map($service, 'id', 'value'))
                    ->label('Выбрать услугу') ?>


            <?php endif; ?>

            <?php if ($place) : ?>


                <?= $form->field($model, 'place')
                    ->dropDownList(ArrayHelper::map($place, 'id', 'value'))
                    ->label('Место встречи') ?>


            <?php endif; ?>

            <?php if ($massagDlya) : ?>


                <?= $form->field($model, 'massagDlya')
                    ->dropDownList(ArrayHelper::map($massagDlya, 'id', 'value'))
                    ->label('Массаж для') ?>


            <?php endif; ?>


            <div class="input-wrap">
                <div class="gray-text m-bottom-15">Цена</div>
                <div class="slider-item d-flex">
                    <div id="notify-price-slider-range">
                        <div id="slider-range-price"></div>

                        <?= $form->field($model, 'min_price')
                            ->hiddenInput([
                                'class' => 'form-input range-input',
                                'placeholder' => '',
                                'template' => '{input}',
                                'value' => 1000,
                            ])
                            ->label(false) ?>


                        <?= $form->field($model, 'max_price')
                            ->hiddenInput([
                                'class' => 'form-input range-input',
                                'placeholder' => '',
                                'template' => '{input}',
                                'value' => 10000,
                            ])
                            ->label(false) ?>

                    </div>
                </div>
                <div class="price-range-wrap d-flex">
                    <div class="min gray-text">1000</div>
                    <div class="max gray-text m-l-auto">10000</div>
                </div>
            </div>


            <div class="input-wrap">
                <div class="gray-text m-bottom-15">Возраст</div>
                <div class="slider-item d-flex">
                    <div id="notify-price-slider-range">
                        <div id="slider-age"></div>

                        <?= $form->field($model, 'min_age')
                            ->hiddenInput([
                                'class' => 'form-input range-input',
                                'placeholder' => '',
                                'template' => '{input}',
                                'value' => 18,
                            ])
                            ->label(false) ?>


                        <?= $form->field($model, 'max_age')
                            ->hiddenInput([
                                'class' => 'form-input range-input',
                                'placeholder' => '',
                                'template' => '{input}',
                                'value' => 99,
                            ])
                            ->label(false) ?>

                    </div>
                </div>
                <div class="age-range-wrap d-flex">
                    <div class="min gray-text">18</div>
                    <div class="max gray-text m-l-auto">99</div>
                </div>
            </div>


            <div class="form-group find-btn-wrap">
                <?= Html::submitButton('Найти', ['class' => 'accent-btn-1']) ?>
            </div>
            <?php ActiveForm::end() ?>

        </div>

    </div>
</div>



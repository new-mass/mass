<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\modules\user\models\Tarif;

/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\Posts */
/* @var $form ActiveForm */
/* @var $userPol \frontend\modules\user\models\relation\UserPol */
/* @var $userWorkTime \frontend\modules\user\models\relation\UserWorckTime */
/* @var $photo \frontend\modules\user\models\Photo */
/* @var $userCheck \frontend\modules\user\models\relation\UserCheckAnket */
/* @var $userPlace \frontend\modules\user\models\relation\UserPlace */
/* @var $userMassagDlya \frontend\modules\user\models\relation\UserMassagDlya */
/* @var $userService \frontend\modules\user\models\relation\UserService */
/* @var $userRayon \frontend\modules\user\models\relation\UserRayon */
/* @var $userComfort \frontend\modules\user\models\relation\UserComfort */
/* @var $city array */
/* @var $userMetro \frontend\modules\user\models\relation\UserMetro */

$pol = ArrayHelper::map(\frontend\modules\user\models\Pol::find()->asArray()->all(), 'id', 'value');
$time = \frontend\modules\user\components\helpers\TimeHelper::generateDayTime();
$check = ArrayHelper::map(\frontend\modules\user\models\CheckAnket::find()->asArray()->all(), 'id', 'value');
$place = ArrayHelper::map(\frontend\modules\user\models\Place::find()->asArray()->all(), 'id', 'value');
$massagDlya = ArrayHelper::map(\frontend\modules\user\models\MassagDlya::find()->asArray()->all(), 'id', 'value');
$service = ArrayHelper::map(\frontend\modules\user\models\Service::find()->asArray()->all(), 'id', 'value');
$rayon = ArrayHelper::map(\frontend\modules\user\models\Rayon::find()->asArray()->where(['city_id' => $city['id']])->all(), 'id', 'value');
$metro = ArrayHelper::map(\frontend\modules\user\models\Metro::find()->asArray()->where(['city_id' => $city['id']])->all(), 'id', 'value');
$comfort = ArrayHelper::map(\frontend\modules\user\models\Comfort::find()->asArray()->all(), 'id', 'value');

$commentForm = new \frontend\modules\user\models\Comments();

?>

<div class="col-12">
    <h1 class="user-name-single"><?php echo $this->title ?></h1>
</div>
<div class="user-cabinet-add">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-3"><?= $form->field($model, 'name') ?> </div>
        <div class="col-3"><?= $form->field($model, 'phone') ?> </div>
        <div class="col-12"></div>
        <div class="col-3 position-relative"><?= $form->field($model, 'price') ?> </div>
        <div class="col-3 position-relative"><?= $form->field($model, 'price_2_hour') ?> </div>


        <div class="col-3 position-relative"><?= $form->field($model, 'work_time') ?>
            <div class="quantity">
                <span class="quantity-arrow-plus-1"><i class="fas fa-plus"></i></span>
                <span class="quantity-arrow-minus-1"><i class="fas fa-minus"></i></span>
            </div>
        </div>
        <div class="col-3 position-relative"><?= $form->field($model, 'breast') ?>
            <div class="quantity">
                <span class="quantity-arrow-plus-1"><i class="fas fa-plus"></i></span>
                <span class="quantity-arrow-minus-1"><i class="fas fa-minus"></i></span>
            </div>
        </div>
        <div class="col-3 position-relative"><?= $form->field($model, 'ves') ?>
            <div class="quantity">
                <span class="quantity-arrow-plus-1"><i class="fas fa-plus"></i></span>
                <span class="quantity-arrow-minus-1"><i class="fas fa-minus"></i></span>
            </div>
        </div>
        <div class="col-3 position-relative"><?= $form->field($model, 'age') ?>
            <div class="quantity">
                <span class="quantity-arrow-plus-1"><i class="fas fa-plus"></i></span>
                <span class="quantity-arrow-minus-1"><i class="fas fa-minus"></i></span>
            </div>
        </div>
        <div class="col-3 position-relative"><?= $form->field($model, 'rost') ?>
            <div class="quantity">
                <span class="quantity-arrow-plus-1"><i class="fas fa-plus"></i></span>
                <span class="quantity-arrow-minus-1"><i class="fas fa-minus"></i></span>
            </div>
        </div>

        <div class="col-12"></div>


        <div class="col-3 select-cust">
            <div><?= $form->field($userPol, 'prop_id')->dropDownList($pol)->label('Выбрать пол') ?> </div>
        </div>

        <div class="col-12"></div>

        <div class="col-12"><label class="control-label">Время работы</label>
        </div>
        <div class="col-3 select-cust">
            <div><?= $form->field($userWorkTime, 'from')->dropDownList(ArrayHelper::map($time, 'key', 'value'))->label('С:') ?> </div>

        </div>
        <div class="col-3 select-cust">

            <div><?= $form->field($userWorkTime, 'to')->dropDownList(ArrayHelper::map($time, 'key', 'value'))->label('До:') ?> </div>

        </div>

        <div class="col-12"></div>


        <div class="col-12 avatar-block">
            <p class="control-label">Аватар</p>

            <div class="avatar-wrap">

                <div class="row">
                    <div class="col-3">
                        <label for="addpostform-image"
                               class="<?php if (isset($model->avatar)) echo 'exist-img' ?> img-label">

                            <?php if (isset($model->avatar)) : ?>

                                <?php $imageLink =  $model->avatar['file'] ?>

                            <?php else : ?>

                                <?php $imageLink = '/img/no-image.png' ?>

                            <?php endif; ?>

                            <span class="img-wrap avatar-prewiew">
                                    <img class="main-img" src="<?php echo $imageLink ?>">
                                </span>


                            <?= $form->field($model, 'avatar')->fileInput(['maxlength' => true, 'accept' => 'image/*', 'id' => 'addpostform-image'])->label(false) ?>

                        </label>
                    </div>
                    <div class="col-9">
                        <p class="small-text">Обязательное поле, интимные <br> части тела должны быть закрыты</p>
                        <label for="addpostform-image" class=" img-label form-btn">
                            Загрузить изображение
                        </label>

                    </div>
                </div>


            </div>

        </div>


        <div class="col-12"><br></div>
        <div class="col-12">
            <p class="control-label">Галерея</p>
            <div class="avatar-wrap">

                <div class="row">
                    <div class="col-12">
                        <p class="small-text">Для получения большего количества заказов желательно добавлять больше
                            фотографий, это повышает доверие к анкете</p>
                    </div>
                    <div class="col-12">


                        <div class="row " id="preview">

                            <?php if (isset($model->gallery) and !empty($model->gallery)) : ?>

                                <?php foreach ($model->gallery as $item) : ?>

                                    <div class="col-2">

                                        <div class="gallery-img-wrap img-wrap">
                                            <img src="<?php echo $item->file ?>" alt="">
                                        </div>

                                    </div>

                                <?php endforeach; ?>

                            <?php else: ?>
                            <?php $i = 0; ?>
                            <?php while ($i < 6) : ?>
                                <div class="col-2">

                                    <div class="gallery-img-wrap img-wrap no-img-item">
                                        <img src="/img/no-image.png" alt="">
                                    </div>

                                </div>
                                <?php
                                $i++;
                            endwhile;
                            ?>

                            <?php endif; ?>
                        </div>

                        <label for="addpostform-gallary"
                               class="<?php if (isset($model->gallery)) echo 'exist-img' ?> img-label">

                            <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*', 'id' => 'addpostform-gallary'])->label(false) ?>
                        </label>
                    </div>
                    <div class="col-12">
                        <label for="addpostform-gallary" class=" img-label form-btn">
                            Загрузить изображение
                        </label>
                        <p class="small-text small-text-grey">Для того чтобы выбрать несколько фото удерживайте
                            клавишу ctrl при клике на нужные фото</p>
                    </div>
                </div>


            </div>

        </div>

        <div class="col-12"><br></div>

        <div class="col-12 check-box-list-admin">

            <?= $form->field($userCheck, 'prop_id', [

            ])->checkboxList($check, ['item' => function ($index, $label, $name, $checked, $value) {

                if ($checked == 1) $check = 'checked';
                else $check = '';

                return "<span class='wrap-check-box-list'><input class='checkbox-cabinet' id='{$name}{$value}' type='checkbox' {$check}  name='{$name}' value='{$value}'><label class='check-box-list-label' for='{$name}{$value}'>{$label}</label></span>";

            }])->label('Подтверждение личности') ?>

            <?php //dd($userCheck); ?>

        </div>

        <div class="col-12"></div>

        <div class="col-12"><br></div>

        <div class="col-12 check-box-list-admin">
            <?= $form->field($userPlace, 'prop_id', [

            ])->checkboxList($place, ['item' => function ($index, $label, $name, $checked, $value) {

                if ($checked == 1) $check = 'checked';
                else $check = '';

                return "<span class='wrap-check-box-list'><input class='checkbox-cabinet' id='{$name}{$value}' type='checkbox' {$check} name='{$name}' value='{$value}'><label class='check-box-list-label' for='{$name}{$value}'>{$label}</label></span>";

            }])->label('Место встречи') ?>


        </div>

        <div class="col-12"><br></div>

        <div class="col-12 check-box-list-admin">
            <?= $form->field($userMassagDlya, 'prop_id', [

            ])->checkboxList($massagDlya, ['item' => function ($index, $label, $name, $checked, $value) {

                if ($checked == 1) $check = 'checked';
                else $check = '';

                return "<span class='wrap-check-box-list'><input class='checkbox-cabinet' id='{$name}{$value}' type='checkbox' {$check} name='{$name}' value='{$value}'><label class='check-box-list-label' for='{$name}{$value}'>{$label}</label></span>";

            }])->label('Я делаю массаж для:') ?>


        </div>

        <div class="col-12"><br></div>

        <div class="col-12 check-box-list-admin">
            <?= $form->field($userService, 'prop_id', [

            ])->checkboxList($service, ['item' => function ($index, $label, $name, $checked, $value) {

                if ($checked == 1) $check = 'checked';
                else $check = '';

                return "<span class='wrap-check-box-list'><input class='checkbox-cabinet' id='{$name}{$value}' type='checkbox' {$check} name='{$name}' value='{$value}'><label class='check-box-list-label' for='{$name}{$value}'>{$label}</label></span>";

            }])->label('Я умею:') ?>


        </div>
        <div class="col-12"><br></div>

        <div class="col-12 check-box-list-admin">
            <?= $form->field($userComfort, 'prop_id', [

            ])->checkboxList($comfort, ['item' => function ($index, $label, $name, $checked, $value) {

                if ($checked == 1) $check = 'checked';
                else $check = '';

                return "<span class='wrap-check-box-list'><input class='checkbox-cabinet' id='{$name}{$value}' type='checkbox' {$check} name='{$name}' value='{$value}'><label class='check-box-list-label' for='{$name}{$value}'>{$label}</label></span>";

            }])->label('Удобства:') ?>


        </div>

        <div class="col-12"><br></div>

        <?php if ($metro) : ?>

        <div class="col-12 check-box-list-admin">
            <?= $form->field($userMetro, 'prop_id', [

            ])->checkboxList($metro, ['item' => function ($index, $label, $name, $checked, $value) {

                if ($checked == 1) $check = 'checked';
                else $check = '';

                return "<span class='wrap-check-box-list'><input class='checkbox-cabinet' id='{$name}{$value}' type='checkbox' {$check} name='{$name}' value='{$value}'><label class='check-box-list-label' for='{$name}{$value}'>{$label}</label></span>";

            }])->label('Метро:') ?>


        </div>

        <?php endif; ?>

        <?php if ($rayon) : ?>

            <div class="col-12"><br></div>

            <div class="col-12 check-box-list-admin">
                <?= $form->field($userRayon, 'prop_id', [

                ])->checkboxList($rayon, ['item' => function ($index, $label, $name, $checked, $value) {

                    if ($checked == 1) $check = 'checked';
                    else $check = '';

                    return "<span class='wrap-check-box-list'><input class='checkbox-cabinet' id='{$name}{$value}' type='checkbox' {$check} name='{$name}' value='{$value}'><label class='check-box-list-label' for='{$name}{$value}'>{$label}</label></span>";

                }])->label('Район:') ?>


            </div>

        <?php endif; ?>

        <div class="col-12"></div>


        <?php $tarifs = ArrayHelper::map(Tarif::find()->select(['name', 'value'])->orderBy('value')->all(), 'value', 'name') ?>

        <div class="tarif-wrap">
            <p class="white-text">
                Анкеты которые публикуются по VIP, TOP, PREMIUM и EXTRA тарифу получают соответствующий стикер на
                анкету
            </p>
            <div><?= $form->field($model, 'tarif_id')->dropDownList($tarifs)->label('Выбрать тариф') ?> </div>
        </div>

        <div class="col-12"><br></div>

        <div class="col-12">
            <div class="text-wrap avatar-wrap">
                <p class="small-text">
                    Описание анкеты очень важно, его читают посетители сайта, постарайтесь описать себя и условия в
                    которых Вы ведете прием рекомендуем написать не менее 250 символов.
                </p>
                <?= $form->field($model, 'about')->textarea()->label('О себе') ?>
            </div>
        </div>

        <div class="col-12">
            <br>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => ' btn accent-btn-1']) ?>
            </div>
        </div>


        <?php ActiveForm::end(); ?>
        <?php if ($model['comments']) : ?>

            <div class="col-12">
                <div class="anket-heading"><h2 class="big-heading">Отзывы</h2></div>
            </div>

            <?php foreach ($model['comments'] as $comment) : ?>

                <?php if (!$comment['parent_id']) : ?>

                    <div class="col-12 otziv" itemprop="review" itemscope="" itemtype="http://schema.org/Review">
                        <meta itemprop="datePublished" content="2020-01-28 <?php echo date('Y-m-d', $comment['created_at']) ?>">
                        <p itemprop="author" class="name"><?php echo $comment['name'] ?> </p>
                        <p itemprop="reviewBody" class="text-comment">
                            <img src="/bitrix/img/vector_21.png" alt="">
                            <span class="rewiew-date"> <?php echo date('Y-m-d', $comment['created_at']) ?>  </span>
                            <br>
                            <?php echo $comment['text'] ?> </p>
                        <?php
                        $formCom = ActiveForm::begin([
                            'action' => '/comment/add',
                            'options' => ['class' => 'row'],
                        ]) ?>
                        <?= $formCom->field($commentForm, 'name' , [ 'options' =>['class' => ' col-12 col-md-12 col-lg-4']])
                            ->label(false)->hiddenInput(['value' => $model['name']]) ?>

                        <?= $formCom->field($commentForm, 'parent_id' , [ 'options' =>['class' => ' col-12 col-md-12 col-lg-4']])
                            ->label(false)->hiddenInput(['value' => $comment['id']]) ?>

                        <?= $formCom->field($commentForm, 'text', [ 'options' =>['class' => 'col-12']])->textarea(['placeholder' => 'Ответ'])->label(false) ?>
                        <div class="col-12 col-sm-4">
                        </div>
                        <?= $formCom->field($commentForm, 'post_id', [ 'options' =>['class' => 'col-12']])->hiddenInput(['value' => $model['id']] )->label(false) ?>

                        <div class="comment-submit form-group">

                            <div class="btn accent-btn-1" onclick="send_comment(this)"><span>Отправить</span></div>

                        </div>
                        <?php ActiveForm::end() ?>

                    </div>

                <?php endif; ?>

                <div class="user-otvet-text">

                    <?php foreach ($model['comments'] as $value) : ?>

                        <?php if ($value['parent_id'] == $comment['id']) : ?>

                            <div>
                                            <span class="img-otwet-wrap">
                                            <img class="about-img" src="<?php echo $model['avatar']['file'] ?>" alt="<?php echo $model['name'] ?>">
                                            </span>
                                <p itemprop="reviewBody" class="about-block">
                                    <img src="/bitrix/img/vector_22.png" alt="">
                                    <span class="rewiew-date">
                                                    <?php echo date('Y-m-d', $value['created_at']) ?></span>
                                    <br>
                                    <?php echo $value['text'] ?> </p>
                            </div>

                        <?php endif; ?>


                    <?php endforeach; ?>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>
    </div>


</div><!-- user-cabinet-add -->
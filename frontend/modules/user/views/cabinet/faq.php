<?php $this->title = 'Ответы на вопросы'; ?>
<?php $this->registerCssFile(Yii::getAlias('@web/css/cabinet.css?v=1'), ['depends' => [\frontend\assets\AppAsset::class]]); ?>
<div class="col-12 col-md-5 col-lg-4 col-xl-3">
    <?php echo \frontend\modules\user\widgets\UserSideBarWidget::widget() ?>
</div>
<div class="col-12 col-md-7 col-lg-8 col-xl-9">
    <h1 class="h1">Ответы на вопросы</h1>
    <p>1. Как добавить свою анкету на сайт? Для того что бы добавить анкету перейдите в раздел <a href="/cabinet/add">Добавить анкету</a>
    заполните все поля формы и нажмите кнопку отправить, после этого анкета будет отправлена на модерацию</p>

    <p>2. Сколько времени занимает модерация? В дневное время модерация проходит быстро, от 10 мин до 2 часов.</p>
    <p>3. Какое решение может принять модератор? Если Ваша анкета не нарушает закон и не несет информации которая может навредить сайту то она будет одобрена.
Если имеются нарушения то Вы получите письмо с просьбой их устранить. Если имеются серьезные нарушения , к примеру детское порно, то такой аккаунт будет немедленно заблокирован либо удален.</p>
    <p>4. Чего не должно быть в анкете? В первую очередь анкета не должна противоречить закону. Так же запрещено выставлять не прикрытые гениталии, и добавлять фото с рекламой других сайтов.</p>
    <p>5. Анкета прошла модерцию что дальше? При положительном балансе она будет автоматически отправлена на публикацию. Если на момент модерации баланс был недостаточным то после пополнения Вы можете поставить анкету публиковаться самостоятельно.</p>
    <p>6. Как пополнить баланс? Для этого перейдите в раздел <a href="/cabinet/pay">
    Пополнить баланс
</a> Укажите нужную сумму и нажмите кнопку "Оплатить" далее следуйте подсказкам.</p>

    <p>7. Что дают тарифы? Чем дороже тариф тем выше выводится Ваша анкета + каждые 5 мин анкеты меняются местами но исключительно в рамках своего тарифа</p>

    <p>8. Как поставить анкету на публикацию? Для того что бы поставить анкету на публикацию нужно нажать кнопку "Поставить на публикацию" на анкете в кабинете</p>
    <p>9. Я могу указывать ссылку на анкету с других источников когда анкета не публикуется? Да, в этом нет ни какой проблемы, анкета доступна по прямой ссылке ВСЕГДА</p>

</div>
<script src="//code.jivosite.com/widget/O6TixAAC9q" async></script>
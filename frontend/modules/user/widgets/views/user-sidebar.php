<?php

/* @var $posts array */
/* @var $totalView integer */
/* @var $dayView integer */

?>
<div class="cabinet-sidebar">
    <ul>
        <li><a href="/cabinet">Главная страница</a></li>
        <li><a href="/cabinet/add">Добавить анкету</a></li>
        <li><a href="/cabinet/call">Заказы на звонок</a> <?php

            if ($count = \common\models\RequestCall::countNotRead(Yii::$app->user->id)) : ?>

                +<?php echo $count ?>

            <?php endif; ?>

        </li>
        <li><a href="/cabinet/history">История платежей</a></li>
        <li><a href="/cabinet/pay">Пополнить баланс (<?php echo Yii::$app->user->identity->cash ?>)</a></li>
        <li><a href="/cabinet/faq">Ответы на вопросы</a></li>
        <li><a href="/cabinet/logout">Выйти</a></li>
    </ul>
</div>
<?php if ($dayView or $totalView) : ?>
<div class="all-stat-block">
    <div class="row">
        <div class="col-12">
            <p class="big-text">
                Общая <br>
                статистика <br>
                анкет
            </p>
        </div>
        <div class="col-6">
            <p class="small-text">Просмотров
                за день:</p>
            <p class="green-text">
                <?php echo $dayView ?>
            </p>
        </div>
        <div class="col-6">
            <p class="small-text">Просмотров
                за все время:</p>
            <p class="green-text">
                <?php echo $totalView ?>
            </p>
        </div>
    </div>
</div>
    <?php endif; ?>
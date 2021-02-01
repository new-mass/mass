<?php
/* @var $this \yii\web\View */
/* @var $items array */

$this->registerCssFile(Yii::getAlias('@web/css/cabinet.css?v=1'), ['depends' => [\frontend\assets\AppAsset::class]]);
$this->title = "Кабинет";
?>
<script src="//code.jivosite.com/widget/O6TixAAC9q" async></script>
<div class="col-12 col-md-5 col-lg-4 col-xl-3">
    <?php echo \frontend\modules\user\widgets\UserSideBarWidget::widget(['posts' => $items ]) ?>
</div>
<div class="col-12 col-md-7 col-lg-8 col-xl-9">
    <div class="row">
        <div class="col-12">
            <h1 class="user-name-single">Здравствуйте, <?php echo Yii::$app->user->identity->username ?></h1>
        </div>
        <div class="col-12">
            <div class="message">
                <p>При пополнении счета <br>
                    Вы получаете бонус в размере 20% от суммы пополнения</p>
            </div>
        </div>
        <?php if (Yii::$app->user->identity['status'] == 9) : ?>

            <div class="col-12">
                <div class="message">
                    <p>Для добавления анкет требуется активировать свой профиль перейдя по ссылке в письме</p>
                </div>
            </div>


        <?php endif; ?>
        <?php
        foreach ($items as $item) {

            echo $this->render(Yii::getAlias('item'), [
                    'item' => $item
            ]);

        }
        ?>
    </div>

</div>
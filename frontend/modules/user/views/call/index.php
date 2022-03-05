<?php
/* @var $this \yii\web\View */
/* @var $requestCallList \common\models\RequestCall[] */

$this->registerCssFile(Yii::getAlias('@web/css/cabinet.css?v=2'), ['depends' => [\frontend\assets\AppAsset::class]]);

$this->title = "Заявки на звонок";

?>
<script src="//code.jivosite.com/widget/O6TixAAC9q" async></script>
<div class="col-12 col-md-5 col-lg-4 col-xl-3">
    <?php echo \frontend\modules\user\widgets\UserSideBarWidget::widget() ?>
</div>
<div class="col-12 col-md-7 col-lg-8 col-xl-9">

    <div class="main-banner">

        <h1><?php echo $this->title ?></h1>

        <?php if ($requestCallList) foreach ($requestCallList as $call) : ?>

            <div class="row">

                <div class="col-12">

                    <div class="request-item-wrap">

                        <div class="row">

                            <div class="col-12 d-flex request-item">

                                <div class="request-item-text">

                                    <?php

                                    switch ($call['status']) {
                                        case \common\models\RequestCall::REQUEST_NOT_VIEW:
                                            echo "Новая заявка на звонок";
                                            break;
                                        case \common\models\RequestCall::REQUEST_VIEW:
                                            echo "Заявка на звонок";
                                            break;
                                    }

                                    ?>

                                    <?php echo \yii\helpers\Html::a($call['phone'], 'tel:+' . $call['phone']) ?>
                                    .
                                    <?php if ($call['text']) echo 'Текст заявки: ' . $call['text'] ?>

                                    , к анкете

                                    <?php

                                        echo \yii\helpers\Html::a(
                                                $call['post']['name'],
                                                '/anketa/'.$call['post']['url']
                                        );

                                    ?>

                                    <br>

                                    <span class="date">
                                                Создана :
                                                        <?php

                                                        if ($call['created_at']) {

                                                            if (date('Ymd', $call['created_at']) == date('Ymd', time())) {

                                                                echo 'Сегодня ' . date('H:m', $call['created_at']);

                                                            } else {

                                                                echo date('Y-m-d H:i:s', $call['created_at']);

                                                            }

                                                        }

                                                        if ($call['created_at'] != $call['updated_at']) {

                                                            echo ', Просмотрена: ';

                                                            echo date('Y-m-d H:i:s', $call['updated_at']);

                                                        }

                                                        ?>
                                            </span>


                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>


</div>
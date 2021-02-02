<?php
/* @var $this \yii\web\View */
$this->registerCssFile(Yii::getAlias('@web/css/cabinet.css'), ['depends' => [\frontend\assets\AppAsset::class]]);
$this->registerJsFile(Yii::getAlias('@web/js/preview.js'), ['depends' => [\frontend\assets\AppAsset::class]]);

$this->title = 'Редактировать анкету';

?>
<div class="col-12 col-md-5 col-lg-4 col-xl-3">
    <?php echo \frontend\modules\user\widgets\UserSideBarWidget::widget() ?>
</div>
<div class="col-12 col-md-7 col-lg-8 col-xl-9">
    <?php echo $this->renderFile(Yii::getAlias('@app/modules/user/views/cabinet/_form.php') , [
        'model' => $model,
        'userPol' => $userPol,
        'userWorkTime' => $userWorkTime,
        'photo' => $photo,
        'userCheck' => $userCheck,
        'userPlace' => $userPlace,
        'userMassagDlya' => $userMassagDlya,
        'userService' => $userService,
        'userRayon' => $userRayon,
        'userComfort' => $userComfort,
        'city' => $city,
        'userMetro' => $userMetro,
    ]); ?>
</div>
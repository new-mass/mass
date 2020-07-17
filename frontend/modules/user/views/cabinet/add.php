<?php
/* @var $this \yii\web\View */
/* @var $city array */
$this->registerCssFile(Yii::getAlias('@web/css/cabinet.css'), ['depends' => [\frontend\assets\AppAsset::class]]);
$this->registerJsFile(Yii::getAlias('@web/js/preview.js'), ['depends' => [\frontend\assets\AppAsset::class]]);

$this->title = 'Добавить анкету';

?>
<div class="col-3">
    <?php echo \frontend\modules\user\widgets\UserSideBarWidget::widget() ?>
</div>
<div class="col-9">
    <?php echo $this->renderFile(Yii::getAlias('@app/modules/user/views/cabinet/_form.php') , [
        'model' => $model,
        'city' => $city,
        'userPol' => $userPol,
        'userWorkTime' => $userWorkTime,
        'photo' => $photo,
        'userCheck' => $userCheck,
        'userPlace' => $userPlace,
        'userMassagDlya' => $userMassagDlya,
        'userService' => $userService,
        'userRayon' => $userRayon,
        'userComfort' => $userComfort,
        'userMetro' => $userMetro,
    ]); ?>
</div>

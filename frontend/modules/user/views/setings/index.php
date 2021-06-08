<?php
/* @var $this \yii\web\View */
/* @var $payForm \frontend\modules\user\models\forms\PayForm */
/* @var $items array */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->registerCssFile(Yii::getAlias('@web/css/cabinet.css'), ['depends' => [\frontend\assets\AppAsset::class]]);

$this->title = "Настройки";

?>
<div class="col-3">
    <?php echo \frontend\modules\user\widgets\UserSideBarWidget::widget() ?>
</div>
<div class="col-9">
    <div class="row">

        <div class="main-banner">

            <h1><?php echo $this->title ?></h1>

        </div>
    </div>

</div>
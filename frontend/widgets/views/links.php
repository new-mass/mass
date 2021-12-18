<?php

/* @var $links array */

?>
<div class="col-12">
    <div class="marc-wrap">

        <?php foreach ($links as $link) { ?>

            <?php echo \yii\helpers\Html::a($link['text'], $link['link'], ['class' => 'marc-item' ])?>

        <?php } ?>

    </div>

</div>

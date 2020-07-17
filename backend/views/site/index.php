<?php

/* @var $this yii\web\View */
/* @var $notCheckPostCount integer */
/* @var $claimCount integer */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-4">
                <a href="/post/index">Новых анкет <?php echo $notCheckPostCount;?></a>
            </div>
            <div class="col-4">
                <a href="/claim/index">Жалобы <?php echo $claimCount;?></a>
            </div>
        </div>

    </div>
</div>

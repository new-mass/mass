<?php
/* @var $item array */
$photoCount = 0;
$metro = false;
?>

    <div class="new-anket">
        <div class="custom-card d-flex flex-row flex-wrap justify-content-between">
            <div class="custom-card-left">
                <div class="custom-card_img">
                    <a target="_blank" href="/anketa/<?php echo $item['url'] ?>">

                        <picture>

                            <?php if (file_exists (Yii::getAlias('@app'.'/web'.$item['avatar']['file']))) : ?>

                                <source srcset="<?= Yii::$app->imageCache->thumbSrc($item['avatar']['file'], '509_636') ?>" media="(max-width: 539px)">

                                <source srcset="<?= Yii::$app->imageCache->thumbSrc($item['avatar']['file'], '290_327') ?>" media="(max-width: 991px)">

                                <source srcset="<?= Yii::$app->imageCache->thumbSrc($item['avatar']['file'], '290_327') ?>" media="(max-width: 1199px)">

                                <source srcset="<?= Yii::$app->imageCache->thumbSrc($item['avatar']['file'], '255_335') ?>">

                            <img width="255px" height="335px" loading="lazy" class="img-<?php echo $item['id']; ?> img-on-listing" src="<?= Yii::$app->imageCache->thumbSrc($item['avatar']['file'], '255_335') ?>" alt="Массажистка <?php echo $item['name'] ?>" title="Массажистка <?php echo $item['name'] ?> ">

                            <?php endif; ?>
                        </picture>
                    </a>

                    <?php if ($item['tarif_id'] == 6) : ?>

                        <div class="extra-block tarif-block"><p>EXTRA</p></div>

                    <?php endif; ?>

                    <?php if ($item['tarif_id'] == 5) : ?>

                        <div class="premium-block tarif-block"><p>PREMIUM</p></div>

                    <?php endif; ?>

                    <?php if ($item['tarif_id'] == 4) : ?>

                        <div class="top-plus-block tarif-block"><p>TOP+</p></div>

                    <?php endif; ?>

                    <?php if ($item['tarif_id'] == 3) : ?>

                        <div class="top-block tarif-block"><p>TOP</p></div>

                    <?php endif; ?>

                    <?php if ($item['tarif_id'] == 2) : ?>

                        <div class="vip-block tarif-block"><p>VIP</p></div>

                    <?php endif; ?>


                    <?php if ($item['video']) : ?>

                        <div class=" tarif-block video-block"><img src="/img/1485477041-play_78590.svg" alt=""></div>

                    <?php endif; ?>
                    
                </div>
                <div class="custom-card-right">
                    <div class="custom-card_data">
                        <a target="_blank" class="url name name-pr" href="/anketa/<?php echo $item['url'] ?>"><span class="fn org"><?php echo $item['name'] ?></span></a>
                        <div class="row">
                            <div class="col-6">
                                <div class="price">
<span>
<span class="text">Сеанс <span class="pricerange"><?php echo $item['price'] ?></span> руб.</span>
</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class=" vosrast">
<span>
 <span class="text">Возраст <span class="pricerange"><?php echo $item['age'] ?> </span>
</span>
</span>
                                </div>
                            </div>
                        </div>
                        <div class="metro">

                            <?php if (isset($item['metro']) and !empty($item['metro'])){

                                $metro = true;

                                foreach ($item['metro'] as $value){ ?>

                                    <a href="/metro_<?php echo $value['url'] ?>"><?php echo $value['value'] ?></a>

                                <?php }

                            }

                            if (!$metro and isset($item['rayon']) and !empty($item['rayon'])){

                                foreach ($item['rayon'] as $value){ ?>

                                    <a href="/rayon_<?php echo $value['url'] ?>"><?php echo $value['value'] ?></a>

                                <?php }

                            }

                                ?>
                        </div>
                    </div>

                    <?php

                        $str = preg_replace("/[^0-9]/", '', $item['phone']);

                        $str = '7'. substr($str, -10);

                    ?>

                    <div class="custom-card_phone">
                        <div class="get-phone"
                             onclick="getPhone(this);yaCounter50332519.reachGoal('PHONE');return true;"
                             data-phone="<?php echo $str ?>"
                             data-id="<?php echo $item['id'] ?>">Показать телефон</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

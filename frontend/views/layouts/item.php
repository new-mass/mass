<?php
/* @var $item array */
/* @var $first bool */
$photoCount = 0;
$metro = false;

echo (new \frontend\components\helpers\MicroHelper())->image($item);

?>

<div class="new-anket post-item">
    <div class="custom-card d-flex flex-row flex-wrap justify-content-between">
        <div class="custom-card-left">
            <div class="custom-card_img">

                <div class="gallery">

                    <div id="carousel-<?php echo $item['id'] ?>" data-interval="false" class="carousel slide"
                         data-ride="carousel">

                        <div class="carousel-inner" onclick="redirect(this)"
                             data-url="/anketa/<?php echo $item['url'] ?>">

                            <?php if ($item['avatar']['file']) : ?>

                                <picture class="carousel-item active picture-<?php echo $item['id'] ?>">

                                    <?php $thumbSrc = Yii::$app->imageCache->thumbSrc($item['avatar']['file'], '510_764') ?>

                                    <source srcset="<?php echo str_replace('.jpg', '.webp', $thumbSrc) ?>"
                                            media="(max-width: 768px)" type="image/webp">

                                    <source srcset="<?php echo $thumbSrc?>"
                                            media="(max-width: 768px)" type="image/jpeg">

                                    <?php $thumbSrc = Yii::$app->imageCache->thumbSrc($item['avatar']['file'], '330_494') ?>

                                    <source srcset="<?php echo str_replace('.jpg', '.webp', $thumbSrc) ?>"
                                            media="(max-width: 991px)"  type="image/webp">

                                    <source srcset="<?php echo $thumbSrc ?>"
                                            media="(max-width: 991px)"  type="image/jpeg">

                                    <?php $thumbSrc = Yii::$app->imageCache->thumbSrc($item['avatar']['file'], '290_435') ?>

                                    <source srcset="<?php echo str_replace('.jpg', '.webp', $thumbSrc) ?>"
                                            media="(max-width: 1199px)" type="image/webp">

                                    <source srcset="<?php echo $thumbSrc ?>"
                                            media="(max-width: 1199px)" type="image/jpeg">

                                    <?php  $thumbSrc = Yii::$app->imageCache->thumbSrc($item['avatar']['file'], '350_524') ?>

                                    <source srcset="<?php echo str_replace('.jpg', '.webp', $thumbSrc) ?>" type="image/webp">

                                    <source srcset="<?php echo $thumbSrc ?>" type="image/jpeg">

                                    <img loading="lazy"
                                         class="img-<?php echo $item['id']; ?> img-on-listing"
                                         src="<?= $thumbSrc ?>"
                                         alt=" <?php echo $item['name'] ?>" title=" <?php echo $item['name'] ?> ">

                                </picture>

                            <?php endif; ?>

                            <?php if ($item['gallery']) : ?>

                                <?php foreach ($item['gallery'] as $file) : ?>


                                    <picture
                                            class="carousel-item picture-<?php echo $file['id'] ?>">

                                        <img loading="lazy" data-id="<?php echo $file['id'] ?>"
                                             class="photo photo-list"
                                             src="<?php echo $file['file'] ?>"
                                             alt="Массажистка <?php echo $item['name'] ?> "
                                             title="Массажистка <?php echo $item['name'] ?> ">

                                    </picture>


                                <?php endforeach; ?>

                            <?php endif; ?>

                        </div>

                        <?php if ($item['gallery']) : ?>

                            <a class="carousel-control-prev" href="#carousel-<?php echo $item['id'] ?>" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-<?php echo $item['id'] ?>" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        <?php endif; ?>

                    </div>

                </div>

                <?php if ($item['check_photo_status']) : ?>

                    <div class="extra-block tarif-block check-block"><p>Фото 100%</p></div>

                <?php endif; ?>

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
                    <a target="_blank" class="url name name-pr" href="/anketa/<?php echo $item['url'] ?>"><span
                                class="fn org"><?php echo $item['name'] ?></span></a>
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

                        <?php if (isset($item['metro']) and !empty($item['metro'])) {

                            $metro = true;

                            foreach ($item['metro'] as $value) { ?>

                                <?php if ($value != end($item['metro'])) $value['value'] .= ',' ?>

                                <a href="/metro_<?php echo $value['url'] ?>"><?php echo $value['value'] ?></a>

                            <?php }

                        }

                        if (!$metro and isset($item['rayon']) and !empty($item['rayon'])) {

                            foreach ($item['rayon'] as $value) { ?>

                                <a href="/rayon_<?php echo $value['url'] ?>"><?php echo $value['value'] ?></a>

                            <?php }

                        }

                        ?>
                    </div>


                </div>

                <div class="custom-card_phone">
                    <a class="get-phone d-block"
                       onclick="getPhone(this);yaCounter50332519.reachGoal('PHONE');return true;"
                       data-id="<?php echo $item['id'] ?>">Показать телефон</a>
                </div>
            </div>
        </div>
    </div>
</div>

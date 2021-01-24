<?php
/* @var $item array */
$photoCount = 0;
$metro = false;
?>

    <div class="new-anket">
        <div class="custom-card d-flex flex-row flex-wrap justify-content-between">
            <div class="custom-card-left">
                <div class="custom-card_img">
                    <a href="/anketa/<?php echo $item['url'] ?>">
                        <picture class="picture-<?php echo $item['id'] ?>">
                            <img onload="removeBlur(this)" loading="lazy" data-id="<?php echo $item['id'] ?>" class="photo photo-list img-<?php echo $item['id'] ?>"
                                 data-src="" src="<?php echo $item['avatar']['file'] ?>"
                                 alt="Массажистка  <?php echo $item['name'] ?>" title="Массажистка <?php echo $item['name'] ?> ">
                        </picture>
                    </a>

                    <?php $photoCount = \frontend\components\helpers\PhotoHelper::getPhotoCount($item['id']) ?>

                    <div data-position="0" onclick="getnextimg(this)" data-active="active" data-count="<?php echo $photoCount ?>" data-id="<?php echo $item['id'] ?>"
                         class="next-img-btn nav-img-btn ">
                        <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.14706 7.10149C0.756536 7.49201 0.756536 8.12518 1.14706 8.5157L7.51102 14.8797C7.90155 15.2702 8.53471 15.2702 8.92523 14.8797C9.31576 14.4891 9.31576 13.856 8.92523 13.4654L3.26838 7.80859L8.92523 2.15174C9.31576 1.76122 9.31576 1.12805 8.92523 0.737526C8.53471 0.347002 7.90155 0.347002 7.51102 0.737526L1.14706 7.10149ZM13.9375 6.80859L1.85417 6.80859V8.80859L13.9375 8.80859V6.80859Z" fill="white"></path>
                        </svg>
                    </div>
                    <div data-position="-2" onclick="getprevimg(this)" data-count="<?php echo $photoCount ?>" data-active="active" data-id="<?php echo $item['id'] ?>"
                         class="prev-img-btn nav-img-btn d-none">
                        <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.0487 7.10149C13.4393 7.49201 13.4393 8.12518 13.0487 8.5157L6.68478 14.8797C6.29426 15.2702 5.66109 15.2702 5.27057 14.8797C4.88004 14.4891 4.88004 13.856 5.27057 13.4654L10.9274 7.80859L5.27057 2.15174C4.88004 1.76122 4.88004 1.12805 5.27057 0.737526C5.66109 0.347002 6.29426 0.347002 6.68478 0.737526L13.0487 7.10149ZM0.258301 6.80859L12.3416 6.80859V8.80859L0.258301 8.80859L0.258301 6.80859Z" fill="white"></path>
                        </svg>
                    </div>

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

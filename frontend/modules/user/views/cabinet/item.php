<?php
/* @var $item array */

?>
<div class="col-6 col-lg-4 col-md-4 col-xl-4 article-item cabinet-item">
    <div class="new-anket">
        <div class="custom-card d-flex flex-row flex-wrap justify-content-between">
            <div class="custom-card-left">
                <div class="custom-card_img">
                    <a target="_blank" href="/<?php echo $item['url'] ?>">
                        <picture class="picture-164">
                            <img onload="removeBlur(this)" loading="lazy" data-id="<?php echo $item['id'] ?>"
                                 class="photo photo-list img-<?php echo $item['id'] ?>"
                                 data-src="" src="<?php echo $item['avatar']['file'] ?>"
                                 alt="Массажистка  <?php echo $item['name'] ?>"
                                 title="Массажистка <?php echo $item['name'] ?> Санкт-Петербург">
                        </picture>
                    </a>
                    <div class="extra-block tarif-block"><p>EXTRA</p></div>
                </div>
                <div class="custom-card-right">
                    <div class="custom-card_data">
                        <a target="_blank" class="url name name-pr" href="/<?php echo $item['url'] ?>"><span
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
                            <div class="row">
                                <div class="col-6">
                                    <p class="small-text">Показов на листинге за день:<p class="black-text">
                                        <?php echo Yii::$app->cache->get(Yii::$app->params['view_today_cache_key'].'_'.date('d').'_'.$item['id']) ?: 0;?>
                                    </p>


                                </div>
                                <div class="col-6">
                                    <p class="small-text">Показов на листинге
                                        за все время:<p class="black-text"><?php echo $item['viewsOnListing']['count'] ?: 0; ?></p></p>
                                </div>
                            </div>
                        </div>

                        <div class="metro">
                            <div class="row">
                                <div class="col-6">
                                    <p class="small-text">Просмотров детальной страницы за день:<p class="black-text">
                                        <?php echo Yii::$app->cache->get(Yii::$app->params['single_view_today_cache_key'].'_'.date('d').'_'.$item['id']) ?: 0; ?>
                                    </p>


                                </div>
                                <div class="col-6">
                                    <p class="small-text">Просмотров детальной страницы
                                        за все время:<p class="black-text"><?php echo $item['viewsOnSingle']['count'] ?: 0; ?></p></p>
                                </div>
                            </div>
                        </div>

                        <div class="metro">
                            <div class="row">
                                <div class="col-6">
                                    <p class="small-text">Просмотров телефона за день:<p class="black-text">
                                        <?php echo Yii::$app->cache->get(Yii::$app->params['phone_view_today_cache_key'].'_'.date('d').'_'.$item['id']) ?: 0; ?>
                                    </p>


                                </div>
                                <div class="col-6">
                                    <p class="small-text">Просмотров телефона
                                        за все время:<p class="black-text"><?php echo $item['viewsPhone']['count'] ?: 0; ?></p></p>
                                </div>
                            </div>
                        </div>

                        <div class="metro">

                            <div class="row">
                                <div class="col-12">
                                    <span class="text">Статус</span>

                                </div>
                                <div class="col-12" >
                                    <?php

                                        if ($item['status'] == \frontend\modules\user\models\Posts::POST_ON_MODERETION)
                                        {
                                            $message = 'На модерации';
                                            $class = 'mod';
                                            $onclick = '';
                                        }
                                        elseif ($item['status'] == \frontend\modules\user\models\Posts::POST_ON_PUBLICATION)
                                        {
                                            $message = 'Снять с публикации';
                                            $class = 'stop';
                                            $onclick = 'onclick="publication(this)"';
                                        }
                                        elseif ($item['status'] == \frontend\modules\user\models\Posts::POST_DONT_PUBLICATION)
                                        {
                                            $message = 'Поставить на публикацию';
                                            $class = 'start';
                                            $onclick = 'onclick="publication(this)"';

                                        }

                                    ?>
                                    <span <?php echo $onclick ?> data-id="<?php echo $item['id']; ?>" class="status-anket status-<?php echo $class ?>"><?php echo $message; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="metro">

                            <div class="row">
                                <div class="col-12"><a href="/cabinet/edit/<?php echo $item['id'] ?> " class="edit">Редактировать анкету</a></div>
                            </div>
                            
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php /* @var $metro array */ ?>
<?php /* @var $rayon array */ ?>
<?php /* @var $service array */ ?>
<?php /* @var $massagDlya array */ ?>
<?php /* @var $place array */ ?>

<?php $img = '<svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M4.77553 6.60825L0.210257 2.04298C-0.0698915 1.76283 -0.0698915 1.30862 0.210257 1.02847C0.490405 0.748322 0.944615 0.748322 1.22476 1.02847L2.93626 2.73997L5.28283 5.18041L7.31816 3.05112L9.34081 1.02847C9.62096 0.748322 10.0752 0.748322 10.3553 1.02847C10.6355 1.30862 10.6355 1.76283 10.3553 2.04298L5.79004 6.60825C5.50989 6.8884 5.05568 6.8884 4.77553 6.60825Z"
      fill="#FB474A"/>
</svg>'; ?>

<div class="botoom-filter-wrap">

    <ul class="filter-ul">

        <?php if (isset($metro) and !empty($metro)) : ?>

            <li class="filter-li">
                <span class="filter-li-item" data-toggle="modal"
                      data-target="#metro-modal">Выбрать метро <?php echo $img ?> </span>
            </li>

        <?php endif; ?>

        <?php if (isset($rayon) and !empty($rayon)) : ?>

            <li class="filter-li">
                <span class="filter-li-item" data-toggle="modal"
                      data-target="#rayon-modal"> Выбрать район <?php echo $img ?> </span>
            </li>

        <?php endif; ?>

        <?php if (isset($service) and !empty($service)) : ?>

            <li class="filter-li">
                <span class="filter-li-item" data-toggle="modal"
                      data-target="#service-modal">Выбрать услугу <?php echo $img ?> </span>
            </li>

        <?php endif; ?>


        <?php if (isset($massagDlya) and !empty($massagDlya)) : ?>

            <li class="filter-li">
                <span class="filter-li-item" data-toggle="modal"
                      data-target="#dlya-modal"> Для кого массаж <?php echo $img ?> </span>
            </li>

        <?php endif; ?>

        <?php if (isset($place) and !empty($place)) : ?>

            <li class="filter-li">
                <span class="filter-li-item" data-toggle="modal"
                      data-target="#place-modal"> Место встречи <?php echo $img ?> </span>
            </li>

        <?php endif; ?>

        <li class="filter-li">
            <span class="filter-li-item" data-toggle="modal"
                  data-target="#age-modal"> Возраст <?php echo $img ?></span>
        </li>

        <li class="filter-li">
            <span class="filter-li-item" data-toggle="modal"
                  data-target="#price-modal"> Цена <?php echo $img ?> </span>
        </li>

    </ul>

</div>

<?php if ($metro) : ?>

    <div class="modal fade list-service-modal" id="metro-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                  xmlns="http://www.w3.org/2000/svg">
                    <rect x="1.41431" width="25" height="2" rx="1" transform="rotate(45 1.41431 0)" fill="#FB474A"/>
                    <rect y="18.2236" width="25" height="2" rx="1" transform="rotate(-45 0 18.2236)" fill="#FB474A"/>
                    </svg>
                    </span>
                    </button>

                </div>
                <div class="modal-body claim-modal-body">

                    <?php

                    foreach ($metro as $metroItem) {


                        echo '<a class="service-href" href="/metro_' . $metroItem['url'] . '" >' . $metroItem['value'] . '</a>';

                    }

                    ?>

                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php if ($rayon) : ?>

    <div class="modal fade list-service-modal" id="rayon-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                  xmlns="http://www.w3.org/2000/svg">
                    <rect x="1.41431" width="25" height="2" rx="1" transform="rotate(45 1.41431 0)" fill="#FB474A"/>
                    <rect y="18.2236" width="25" height="2" rx="1" transform="rotate(-45 0 18.2236)" fill="#FB474A"/>
                    </svg>
                    </span>
                    </button>

                </div>
                <div class="modal-body claim-modal-body">

                    <?php

                    foreach ($rayon as $metroItem) {


                        echo '<a class="service-href" href="/rayon_' . $metroItem['url'] . '" >' . $metroItem['value'] . '</a>';

                    }

                    ?>

                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php if ($service) : ?>

    <div class="modal fade list-service-modal" id="service-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                  xmlns="http://www.w3.org/2000/svg">
                    <rect x="1.41431" width="25" height="2" rx="1" transform="rotate(45 1.41431 0)" fill="#FB474A"/>
                    <rect y="18.2236" width="25" height="2" rx="1" transform="rotate(-45 0 18.2236)" fill="#FB474A"/>
                    </svg>
                    </span>
                    </button>

                </div>
                <div class="modal-body claim-modal-body">

                    <?php

                    foreach ($service as $serviceItem) {

                        echo '<a href="/service_' . $serviceItem['url'] . '" >' . $serviceItem['value'] . '</a>';

                    }

                    ?>

                </div>
            </div>
        </div>
    </div>

<?php endif; ?>


<div class="modal fade list-service-modal" id="dlya-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                  xmlns="http://www.w3.org/2000/svg">
                    <rect x="1.41431" width="25" height="2" rx="1" transform="rotate(45 1.41431 0)" fill="#FB474A"/>
                    <rect y="18.2236" width="25" height="2" rx="1" transform="rotate(-45 0 18.2236)" fill="#FB474A"/>
                    </svg>
                    </span>
                </button>

            </div>
            <div class="modal-body claim-modal-body">

                <?php

                foreach ($massagDlya as $massazhDlyaItem) {

                    echo '<a class="service-href" href="/massazh-dlya_' . $massazhDlyaItem['url'] . '" >Массаж для  ' . $massazhDlyaItem['value'] . '</a>';
                }

                ?>

            </div>
        </div>
    </div>
</div>

<div class="modal fade list-service-modal" id="place-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                  xmlns="http://www.w3.org/2000/svg">
                    <rect x="1.41431" width="25" height="2" rx="1" transform="rotate(45 1.41431 0)" fill="#FB474A"/>
                    <rect y="18.2236" width="25" height="2" rx="1" transform="rotate(-45 0 18.2236)" fill="#FB474A"/>
                    </svg>
                    </span>
                </button>

            </div>
            <div class="modal-body claim-modal-body">

                <?php

                foreach ($place as $placeList) {


                    echo '<a class="service-href" href="/place_' . $placeList['url'] . '" >' . $placeList['value'] . '</a>';

                }

                ?>

            </div>
        </div>
    </div>
</div>

<div class="modal fade list-service-modal" id="age-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                  xmlns="http://www.w3.org/2000/svg">
                    <rect x="1.41431" width="25" height="2" rx="1" transform="rotate(45 1.41431 0)" fill="#FB474A"/>
                    <rect y="18.2236" width="25" height="2" rx="1" transform="rotate(-45 0 18.2236)" fill="#FB474A"/>
                    </svg>
                    </span>
                </button>

            </div>
            <div class="modal-body claim-modal-body">

                <a class="service-href" href="/age_ot-18-do-20-let">От 18 до 20 лет</a>
                <a class="service-href" href="/age_ot-21-do-25-let">От 21 до 25 лет</a>
                <a class="service-href" href="/age_ot-26-do-30-let">От 26 до 30 лет</a>
                <a href="/age_ot-31-do-40-let">От 31 до 40 лет</a>
                <a class="service-href" href="/age_ot-40-do-50-let">от 40 до 50 лет</a>
                <a class="service-href" href="/age_starshe-51-goda">Старше 51 года</a>

            </div>
        </div>
    </div>
</div>

<div class="modal fade list-service-modal" id="price-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                  xmlns="http://www.w3.org/2000/svg">
                    <rect x="1.41431" width="25" height="2" rx="1" transform="rotate(45 1.41431 0)" fill="#FB474A"/>
                    <rect y="18.2236" width="25" height="2" rx="1" transform="rotate(-45 0 18.2236)" fill="#FB474A"/>
                    </svg>
                    </span>
                </button>

            </div>
            <div class="modal-body claim-modal-body">

                <a class="service-href" href="/price_do-2000">До 2.000 Рублей</a>
                <a class="service-href" href="/price_ot-2000-do-3000">От 2.000 до 3.000 Рублей</a>
                <a class="service-href" href="/price_ot-3000">От 3.000 Рублей</a>

            </div>
        </div>
    </div>
</div>


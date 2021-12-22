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

    <?php if (isset($metro) and !empty($metro)) : ?>

        <div class="filter-list">

            <div class="filter-list-heading">
                Выбрать метро:
            </div>

            <?php

            foreach ($metro as $metroItem) {

                echo '<a class="service-href filter-list-item" href="/metro_' . $metroItem['url'] . '" >' . $metroItem['value'] . '</a>';

            }

            ?>

        </div>

    <?php endif; ?>

    <?php if (isset($rayon) and !empty($rayon)) : ?>

        <div class="filter-list">

            <div class="filter-list-heading">
                Выбрать район:
            </div>

            <?php

            foreach ($rayon as $metroItem) {

                echo '<a class="service-href filter-list-item" href="/rayon_' . $metroItem['url'] . '" >' . $metroItem['value'] . '</a>';

            }

            ?>

        </div>

    <?php endif; ?>

    <?php if (isset($service) and !empty($service)) : ?>

        <div class="filter-list">

            <div class="filter-list-heading">
                Выбрать услугу:
            </div>

            <?php

            foreach ($service as $metroItem) {

                echo '<a class="service-href filter-list-item" href="/service_' . $metroItem['url'] . '" >' . $metroItem['value'] . '</a>';

            }

            ?>

        </div>

    <?php endif; ?>

    <?php if (isset($massagDlya) and !empty($massagDlya)) : ?>

        <div class="filter-list">

            <div class="filter-list-heading">
                Для кого массаж:
            </div>

            <?php

            foreach ($massagDlya as $metroItem) {

                echo '<a class="service-href filter-list-item" href="/massazh-dlya_' . $metroItem['url'] . '" >' . $metroItem['value'] . '</a>';

            }

            ?>

        </div>

    <?php endif; ?>

    <?php if (isset($place) and !empty($place)) : ?>

        <div class="filter-list">

            <div class="filter-list-heading">
                Место встречи:
            </div>

            <?php

            foreach ($place as $metroItem) {

                echo '<a class="service-href filter-list-item" href="/place_' . $metroItem['url'] . '" >' . $metroItem['value'] . '</a>';

            }

            ?>

        </div>

    <?php endif; ?>


    <div class="filter-list">

        <div class="filter-list-heading">
            Возраст:
        </div>

        <a class="service-href filter-list-item" href="/age_ot-18-do-20-let">От 18 до 20 лет</a>
        <a class="service-href filter-list-item" href="/age_ot-21-do-25-let">От 21 до 25 лет</a>
        <a class="service-href filter-list-item" href="/age_ot-26-do-30-let">От 26 до 30 лет</a>
        <a class="service-href filter-list-item" href="/age_ot-31-do-40-let">От 31 до 40 лет</a>
        <a class="service-href filter-list-item" href="/age_ot-40-do-50-let">от 40 до 50 лет</a>
        <a class="service-href filter-list-item" href="/age_starshe-51-goda">Старше 51 года</a>

    </div>

    <div class="filter-list">

        <div class="filter-list-heading">
            Цена:
        </div>

        <a class="service-href filter-list-item" href="/price_do-2000">До 2.000 Рублей</a>
        <a class="service-href filter-list-item" href="/price_ot-2000-do-3000">От 2.000 до 3.000 Рублей</a>
        <a class="service-href filter-list-item" href="/price_ot-3000">От 3.000 Рублей</a>

    </div>

</div>

<?php /* @var $metro array */ ?>
<?php /* @var $rayon array */ ?>
<?php /* @var $service array */ ?>
<?php /* @var $massagDlya array */ ?>
<?php /* @var $place array */ ?>

<div class="filter">

    <div class="mobile-filter">
        <div class="open-filter-btn">
            <span>Развернуть фильтр поиска</span>
            <span class="d-none">Свернуть фильтр</span>
        </div>

        <div class="mobile-filter-content-wrap">

        </div>

    </div>

    <ul class="filter-ul">

        <?php if (isset($metro) and !empty($metro)) : ?>

            <li class="filter-li">
                    <span class="filter-li-item"> Метро <svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M4.77553 6.60825L0.210257 2.04298C-0.0698915 1.76283 -0.0698915 1.30862 0.210257 1.02847C0.490405 0.748322 0.944615 0.748322 1.22476 1.02847L2.93626 2.73997L5.28283 5.18041L7.31816 3.05112L9.34081 1.02847C9.62096 0.748322 10.0752 0.748322 10.3553 1.02847C10.6355 1.30862 10.6355 1.76283 10.3553 2.04298L5.79004 6.60825C5.50989 6.8884 5.05568 6.8884 4.77553 6.60825Z"
      fill="#FB474A"/>
</svg>
 </span>
                <span class="filter-drop-down <?php if (count($metro) > 10) echo 'long-ul' ?>">
                        <?php

                        foreach ($metro as $metroItem) {


                            echo '<a class="service-href" title="Массажистки у метро  ' . $metroItem['value'] . '" href="/metro_' . $metroItem['url'] . '" >' . $metroItem['value'] . '</a>';

                        }

                        ?>
                    </span>
            </li>

        <?php endif; ?>

        <?php if (isset($rayon) and !empty($rayon)) : ?>

            <li class="filter-li">
                <span class="filter-li-item"> Районы <svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                                                          xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M4.77553 6.60825L0.210257 2.04298C-0.0698915 1.76283 -0.0698915 1.30862 0.210257 1.02847C0.490405 0.748322 0.944615 0.748322 1.22476 1.02847L2.93626 2.73997L5.28283 5.18041L7.31816 3.05112L9.34081 1.02847C9.62096 0.748322 10.0752 0.748322 10.3553 1.02847C10.6355 1.30862 10.6355 1.76283 10.3553 2.04298L5.79004 6.60825C5.50989 6.8884 5.05568 6.8884 4.77553 6.60825Z"
      fill="#FB474A"/>
</svg>
 </span>
                <span class="filter-drop-down <?php if (count($rayon) > 10) echo 'long-ul' ?>">
                    <?php

                    foreach ($rayon as $metroItem) {


                        echo '<a class="service-href" title="Массажистки в районе  ' . $metroItem['value'] . '" href="/rayon_' . $metroItem['url'] . '" >' . $metroItem['value'] . '</a>';

                    }

                    ?>
                </span>
            </li>

        <?php endif; ?>

        <?php if (isset($service) and !empty($service)) : ?>

            <li class="filter-li">
                        <span class="filter-li-item"> Услуга <svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                                                                  xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M4.77553 6.60825L0.210257 2.04298C-0.0698915 1.76283 -0.0698915 1.30862 0.210257 1.02847C0.490405 0.748322 0.944615 0.748322 1.22476 1.02847L2.93626 2.73997L5.28283 5.18041L7.31816 3.05112L9.34081 1.02847C9.62096 0.748322 10.0752 0.748322 10.3553 1.02847C10.6355 1.30862 10.6355 1.76283 10.3553 2.04298L5.79004 6.60825C5.50989 6.8884 5.05568 6.8884 4.77553 6.60825Z"
      fill="#FB474A"/>
</svg>
 </span>
                <span class="filter-drop-down long-ul">
                            <?php

                            foreach ($service as $serviceItem) {

                                echo '<a class="service-href" title="Страница массажистов с услугой  ' . $serviceItem['value'] . '" href="/service_' . $serviceItem['url'] . '" >' . $serviceItem['value'] . '</a>';

                            }

                            ?>
                        </span>
            </li>

        <?php endif; ?>


        <?php if (isset($massagDlya) and !empty($massagDlya)) : ?>

            <li class="filter-li">
                <span class="filter-li-item"> Для кого массаж <svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                                                                   xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M4.77553 6.60825L0.210257 2.04298C-0.0698915 1.76283 -0.0698915 1.30862 0.210257 1.02847C0.490405 0.748322 0.944615 0.748322 1.22476 1.02847L2.93626 2.73997L5.28283 5.18041L7.31816 3.05112L9.34081 1.02847C9.62096 0.748322 10.0752 0.748322 10.3553 1.02847C10.6355 1.30862 10.6355 1.76283 10.3553 2.04298L5.79004 6.60825C5.50989 6.8884 5.05568 6.8884 4.77553 6.60825Z"
      fill="#FB474A"/>
</svg>
 </span>
                <span class="filter-drop-down">
                <?php

                foreach ($massagDlya as $massazhDlyaItem) {

                    echo '<a class="service-href" title="Массажист для   ' . $massazhDlyaItem['value'] . '" href="/massazh-dlya_' . $massazhDlyaItem['url'] . '" >Массаж для  ' . $massazhDlyaItem['value'] . '</a>';
                }

                ?>
                </span>
            </li>

        <?php endif; ?>

        <?php if (isset($place) and !empty($place)) : ?>

            <li class="filter-li">
                <span class="filter-li-item"> Место встречи <svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M4.77553 6.60825L0.210257 2.04298C-0.0698915 1.76283 -0.0698915 1.30862 0.210257 1.02847C0.490405 0.748322 0.944615 0.748322 1.22476 1.02847L2.93626 2.73997L5.28283 5.18041L7.31816 3.05112L9.34081 1.02847C9.62096 0.748322 10.0752 0.748322 10.3553 1.02847C10.6355 1.30862 10.6355 1.76283 10.3553 2.04298L5.79004 6.60825C5.50989 6.8884 5.05568 6.8884 4.77553 6.60825Z"
      fill="#FB474A"/>
</svg>
 </span>
                <span class="filter-drop-down">
                    <?php

                    foreach ($place as $placeList) {


                        echo '<a class="service-href" title="Место встречи с массажистом  ' . $placeList['value'] . '" href="/place_' . $placeList['url'] . '" >' . $placeList['value'] . '</a>';

                    }

                    ?>
                </span>
            </li>

        <?php endif; ?>


        <?php if (isset($ageList) and !empty($ageList)) : ?>

            <li class="filter-li">
                <span class="filter-li-item"> Возраст <svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                                                           xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M4.77553 6.60825L0.210257 2.04298C-0.0698915 1.76283 -0.0698915 1.30862 0.210257 1.02847C0.490405 0.748322 0.944615 0.748322 1.22476 1.02847L2.93626 2.73997L5.28283 5.18041L7.31816 3.05112L9.34081 1.02847C9.62096 0.748322 10.0752 0.748322 10.3553 1.02847C10.6355 1.30862 10.6355 1.76283 10.3553 2.04298L5.79004 6.60825C5.50989 6.8884 5.05568 6.8884 4.77553 6.60825Z"
      fill="#FB474A"/>
</svg>
 </span>
                <span class="filter-drop-down">
                    <?php

                    foreach ($ageList as $ageItem) {

                        echo '<a class="service-href" title="Страница массажистов возрастом  ' . $ageItem['value'] . '" href="/age_' . $ageItem['url'] . '" >' . $ageItem['value'] . '</a>';

                    }

                    ?>
                </span>
            </li>

        <?php endif; ?>

        <?php if (isset($pricelList) and !empty($pricelList)) : ?>

            <li class="filter-li">
                <span class="filter-li-item"> Цена <svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M4.77553 6.60825L0.210257 2.04298C-0.0698915 1.76283 -0.0698915 1.30862 0.210257 1.02847C0.490405 0.748322 0.944615 0.748322 1.22476 1.02847L2.93626 2.73997L5.28283 5.18041L7.31816 3.05112L9.34081 1.02847C9.62096 0.748322 10.0752 0.748322 10.3553 1.02847C10.6355 1.30862 10.6355 1.76283 10.3553 2.04298L5.79004 6.60825C5.50989 6.8884 5.05568 6.8884 4.77553 6.60825Z"
      fill="#FB474A"/>
</svg>
 </span>
                <ul class="filter-drop-down">
                    <?php

                    foreach ($pricelList as $priceItem) {

                        echo '<li><a class="service-href" title="Страница массажистов с ценой  ' . $priceItem['value'] . '" href="/price_' . $priceItem['url'] . '" >' . $priceItem['value'] . '</a></li>';


                    }

                    ?>
                </ul>
            </li>

        <?php endif; ?>

        <li class="filter-li">
<span class="filter-li-item"> Возраст <svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                                           xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M4.77553 6.60825L0.210257 2.04298C-0.0698915 1.76283 -0.0698915 1.30862 0.210257 1.02847C0.490405 0.748322 0.944615 0.748322 1.22476 1.02847L2.93626 2.73997L5.28283 5.18041L7.31816 3.05112L9.34081 1.02847C9.62096 0.748322 10.0752 0.748322 10.3553 1.02847C10.6355 1.30862 10.6355 1.76283 10.3553 2.04298L5.79004 6.60825C5.50989 6.8884 5.05568 6.8884 4.77553 6.60825Z"
      fill="#FB474A"></path>
</svg>
</span>
            <span class="filter-drop-down">
<a class="service-href" title="Страница массажистов возрастом  От 18 до 20 лет" href="/age_ot-18-do-20-let">От 18 до 20 лет</a><a
                        class="service-href" title="Страница массажистов возрастом  От 21 до 25 лет"
                        href="/age_ot-21-do-25-let">От 21 до 25 лет</a><a class="service-href"
                                                                          title="Страница массажистов возрастом  От 26 до 30 лет"
                                                                          href="/age_ot-26-do-30-let">От 26 до 30 лет</a><a
                        class="service-href" title="Страница массажистов возрастом  От 31 до 40 лет"
                        href="/age_ot-31-do-40-let">От 31 до 40 лет</a><a class="service-href"
                                                                          title="Страница массажистов возрастом  от 40 до 50 лет"
                                                                          href="/age_ot-40-do-50-let">от 40 до 50 лет</a><a
                        class="service-href" title="Страница массажистов возрастом  Старше 51 года"
                        href="/age_starshe-51-goda">Старше 51 года</a> </span>
        </li>
        <li class="filter-li">

<span class="filter-li-item"> Цена <svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd"
      d="M4.77553 6.60825L0.210257 2.04298C-0.0698915 1.76283 -0.0698915 1.30862 0.210257 1.02847C0.490405 0.748322 0.944615 0.748322 1.22476 1.02847L2.93626 2.73997L5.28283 5.18041L7.31816 3.05112L9.34081 1.02847C9.62096 0.748322 10.0752 0.748322 10.3553 1.02847C10.6355 1.30862 10.6355 1.76283 10.3553 2.04298L5.79004 6.60825C5.50989 6.8884 5.05568 6.8884 4.77553 6.60825Z"
      fill="#FB474A"></path>
</svg>
</span>
            <ul class="filter-drop-down">
                <a class="service-href" title="Страница массажистов с ценой  До 2.000 Рублей" href="/price_do-2000">До
                        2.000 Рублей</a>
                <a class="service-href" title="Страница массажистов с ценой  От 2.000 до 3.000 Рублей"
                       href="/price_ot-2000-do-3000">От 2.000 до 3.000 Рублей</a>
                <a class="service-href" title="Страница массажистов с ценой  От 3.000 Рублей" href="/price_ot-3000">От
                        3.000 Рублей</a>
            </ul>
        </li>

    </ul>


</div>
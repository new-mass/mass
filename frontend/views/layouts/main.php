<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\assets\FontAwesomeAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);
FontAwesomeAsset::register($this);

$searchForm = new \frontend\models\forms\SearchForm();
$claimForm = new \frontend\models\forms\ClaimForm();

$this->registerJsFile('/js/single.js', ['depends' => [\frontend\assets\AppAsset::class]]);
$this->registerJsFile('/js/script.js?v=1', ['depends' => [\frontend\assets\AppAsset::class]]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="/img/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/img/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/img/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="/img/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#4d0862">
    <meta name="msapplication-TileImage" content="/img/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#4d0862">
    <?php

    if (strpos(Yii::$app->request->url,'?')){
        echo '<link rel="canonical" href="'.strstr(Yii::$app->request->url, '?', true).'">';
    }

    ?>

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body>
<nav class="menu">
    <svg class="close-menu" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="2.36816" width="25" height="2" transform="rotate(45 2.36816 0)" fill="white"/>
        <rect x="0.954102" y="17.6777" width="25" height="2" transform="rotate(-45 0.954102 17.6777)" fill="white"/>
    </svg>

    <ul class="main-nav_list" itemscope itemtype="http://www.schema.org/SiteNavigationElement">

        <li itemprop="name"><a itemprop="url" title="Главная страница" href="/"> Главная</a> </li>
        <li itemprop="name"><a itemprop="url" title="Страница эротического массажа" href="/service_eroticheskiy">Эротический массаж</a></li>
        <li itemprop="name"><a itemprop="url" title="Страница тайского массажа" href="/service_tayskiy">Тайский массаж</a></li>
        <li itemprop="name"><a itemprop="url" title="Массж надому" href="/place_appartamentu">На дому</a></li>
        <li itemprop="name"><a itemprop="url" title="Элитные мастера массажа" href="/price_ot-3000">Элитные массажистки</a></li>
        <li itemprop="name"><a itemprop="url" title="Анкеты мастеров массажа которые делают массаж для мужчин" href="/massazh-dlya_muzhchin">Массаж для мужчин</a></li>

        <li>
            <a class="teh-pod white-text" data-toggle="modal" data-target="#claim-modal" href="#">Техподдержка</a>
        </li>

        <li data-toggle="modal" data-target="#registerModal" class="add-anket-li"><img src="/bitrix/img/dancing.png" alt=""> Разместить анкету</li>

    </ul>



</nav>
<header class="default-header">
    <div class="container main-container">
        <div class="row">
            <div class="col-7 col-lg-3 col-md-6 col-sm-5">
                <div class="row">
                    <div class="col-3 col-lg-2 col-md-2 col-sm-3 show-menu">
                        <svg width="25" height="14" viewBox="0 0 25 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="25" height="2" fill="white"/>
                            <rect y="6" width="25" height="2" fill="white"/>
                            <rect y="12" width="25" height="2" fill="white"/>
                        </svg>

                    </div>
                    <div class="col-9 col-lg-10 col-md-10 col-sm-9">

                        <a href="/" class="logo"><img class="logo-img" src="/img/logo.png"
                                                      alt="Частные массажистки мск"
                                                      title="Главная"></a>

                        <script type="application/ld+json">
                            {
                                "@context": "http://schema.org",
                                "@type": "Organization",
                                "url": "https://korolev.e-mass.top",
                                "logo": "https://korolev.e-mass.top/imgs/logo.png"
                            }
                        </script>

                    </div>
                </div>
            </div>
            <div class="col-5 col-lg-9 col-md-6 col-sm-7 right-row-nav">

                <div class="row">
                    <div class="col-2 col-lg-3 col-md-3 prosmotreno-wrap">
                        <div class="cart">
                            <a href="/prosmotreno"><span class="view-text"> Просмотрено</span><span
                                        class="bg"></span><span id="prosmotri-count">
                                    0
                                </span></a>
                        </div>
                    </div>

                    <div class="col-2 col-md-3 teh-pod-wrap">
                        <a class="teh-pod white-text" data-toggle="modal" data-target="#claim-modal" href="#">Техподдержка</a>
                    </div>

                    <div class="col-xl-3 col-6 col-lg-4 col-md-6 col-sm-8  search-form-wrap">

                        <?php

                        $form = ActiveForm::begin([
                            'action' => '/search',
                            'options' => ['class' => 'search-form'],
                        ]) ?>
                        <?= $form->field($searchForm, 'name')->textInput(['placeholder' => 'Введите имя'])->label(false) ?>

                        <?= Html::submitButton('<i class="fas fa-search"></i>', ['class' => 'search-form_submit']) ?>

                        <?php ActiveForm::end() ?>

                    </div>

                    <div class="col-12 col-lg-2 col-md-6 col-sm-4 cabinet_a-wrap">

                        <?php
                        if (Yii::$app->user->isGuest) {
                            $loginLink = '/cabinet/login';
                            $loginLinkText= 'Войти';
                        }
                        else {
                            $loginLinkText= 'Кабинет';
                            $loginLink = '/cabinet';

                        }
                        ?>

                        <a class="cabinet_a white-text" href="<?php echo $loginLink; ?>">


                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.68539 14.3708C3.28183 18.4247 7.12502 21.0436 11.4782 21.0436C17.2796 21.0436 22 16.3231 22 10.5218C22 4.72049 17.2796 0 11.4782 0C7.12502 0 3.28183 2.61893 1.68539 6.67282C1.54002 7.0401 1.72164 7.45712 2.08997 7.60249C2.45725 7.74593 2.87427 7.56711 3.02069 7.19686C4.39908 3.69695 7.71912 1.43478 11.4782 1.43478C16.4884 1.43478 20.5653 5.51162 20.5653 10.5218C20.5653 15.532 16.4884 19.6088 11.4782 19.6088C7.71912 19.6088 4.39908 17.3466 3.02069 13.8467C2.87532 13.4765 2.45725 13.2977 2.08997 13.4411C1.72164 13.5865 1.54002 14.0035 1.68539 14.3708ZM10.7609 15.0652C10.5772 15.0652 10.3936 14.9955 10.2539 14.8549C9.97364 14.5747 9.97364 14.1203 10.2539 13.8399L12.8547 11.2392H0.717391C0.32139 11.2392 0 10.9178 0 10.5218C0 10.1258 0.32139 9.80441 0.717391 9.80441H12.8565L10.2539 7.20178C9.97364 6.92154 9.97364 6.46704 10.2539 6.18681C10.5343 5.90658 10.9886 5.90658 11.2688 6.18681L15.0949 10.013C15.345 10.2632 15.3719 10.652 15.1755 10.9319C15.1472 10.9723 15.115 11.0097 15.0792 11.0434L11.2688 14.8538C11.1282 14.9955 10.9446 15.0652 10.7609 15.0652Z" fill="#FB474A"/>
                            </svg>
                            <?php echo $loginLinkText ?>
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
</header>

<div class="wrap">

    <div class="container">

        <?php if (Yii::$app->controller->id != 'cabinet' and Yii::$app->controller->id != 'cash' and Yii::$app->controller->id != 'hystory') : ?>
            <?php echo \frontend\widgets\FilterWidget::widget(['city' => Yii::$app->controller->actionParams['city']]); ?>
        <?php endif ?>

        <div class="row content">
            <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
            <div class="col-12">
                <?= Alert::widget() ?>
            </div>
        <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">

</footer>
<div class="modal fade" id="claim-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="1.41431" width="25" height="2" rx="1" transform="rotate(45 1.41431 0)" fill="#FB474A"/>
                    <rect y="18.2236" width="25" height="2" rx="1" transform="rotate(-45 0 18.2236)" fill="#FB474A"/>
                    </svg>
                    </span>
                </button>

            </div>
            <div class="modal-body claim-modal-body">
                <?php echo \frontend\widgets\ClaimFormWidget::widget() ?>
            </div>
    </div>
</div>

<?php $this->endBody() ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(50332519, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/50332519" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</body>
</html>
<?php $this->endPage() ?>

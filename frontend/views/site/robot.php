<?php
/* @var $host string */
header('Content-Type: text/plain; charset=UTF-8');

if(Yii::$app->request->hostName == 'moskva.e-mass.top') : ?>

    Disallow: /

    <?php else: ?>
    User-agent: *
    Disallow: */pol_*
    Disallow: */no-age*
    Disallow: */amp*
    Disallow: /amp*
    Disallow: /cpay*
    Disallow: /call/*
    Disallow: /*?__cf*
    Disallow: /new-post
    Clean-param: price
    Disallow: /filter?
    Host: https://<?php echo $host.PHP_EOL ?>
    Sitemap: https://<?php echo $host ?>/sitemap.xml
<?php exit() ?>
<?php endif; ?>

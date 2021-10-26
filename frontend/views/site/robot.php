<?php
/* @var $host string */
header('Content-Type: text/plain; charset=UTF-8');
?>
    User-agent: *
    Disallow: */pol_*
    Disallow: */no-age*
    Disallow: */amp*
    Disallow: /amp*
    Disallow: /*?__cf*
    Disallow: /new-post
    Clean-param: sort
    Host: https://<?php echo $host.PHP_EOL ?>
    Sitemap: https://<?php echo $host ?>/sitemap.xml
<?php exit() ?>
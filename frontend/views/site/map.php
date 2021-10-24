<?php /* @var $metro array */ ?>
<?php /* @var $rayon array */ ?>
<?php /* @var $service array */ ?>
<?php /* @var $place array */ ?>
<?php /* @var $naci array */ ?>
<?php /* @var $hair array */ ?>
<?php /* @var $intimHair array */ ?>
<?php /* @var $massgDlya array */ ?>
<?php /* @var $posts array */ ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'; ?>
<url>
    <loc>https://<?php echo Yii::$app->request->serverName?></loc>
    <lastmod>2021-10-24</lastmod>
    <priority>1</priority>
</url>
<url>
    <loc>https://<?php echo Yii::$app->request->serverName?>/age_ot-18-do-20-let</loc>
    <lastmod>2021-10-24</lastmod>
    <priority>0.9</priority>
</url>
<url>
    <loc>https://<?php echo Yii::$app->request->serverName?>/age_ot-21-do-25-let</loc>
    <lastmod>2021-10-24</lastmod>
    <priority>0.9</priority>
</url>
<url>
    <loc>https://<?php echo Yii::$app->request->serverName?>/age_ot-31-do-40-let</loc>
    <lastmod>2021-10-24</lastmod>
    <priority>0.9</priority>
</url>
<url>
    <loc>https://<?php echo Yii::$app->request->serverName?>/age_ot-40-do-50-let</loc>
    <lastmod>2021-10-24</lastmod>
    <priority>0.9</priority>
</url>
<url>
    <loc>https://<?php echo Yii::$app->request->serverName?>/age_starshe-51-goda</loc>
    <lastmod>2021-10-24</lastmod>
    <priority>0.9</priority>
</url>
<url>
    <loc>https://<?php echo Yii::$app->request->serverName?>/price_ot-3000'</loc>
    <lastmod>2021-10-24</lastmod>
    <priority>0.9</priority>
</url>
<url>
    <loc>https://<?php echo Yii::$app->request->serverName?>/price_ot-2000-do-3000'</loc>
    <lastmod>2021-10-24</lastmod>
    <priority>0.9</priority>
</url>
<url>
    <loc>https://<?php echo Yii::$app->request->serverName?>/price_do-2000'</loc>
    <lastmod>2021-10-24</lastmod>
    <priority>0.9</priority>
</url>

<?php if ($metro) foreach ($metro as $metroItem) : ?>
    <url>
        <loc>https://<?php echo Yii::$app->request->serverName?>/metro_<?php echo $metroItem['url']?></loc>
        <lastmod>2021-10-24</lastmod>
        <priority>0.9</priority>
    </url>
<?php endforeach; ?>
<?php if ($massgDlya) foreach ($massgDlya as $massgDlyaItem) : ?>
    <url>
        <loc>https://<?php echo Yii::$app->request->serverName?>/massazh-dlya_<?php echo $massgDlyaItem['url']?></loc>
        <lastmod>2021-10-24</lastmod>
        <priority>0.9</priority>
    </url>
<?php endforeach; ?>

<?php if ($rayon) foreach ($rayon as $rayonItem) : ?>
    <url>
        <loc>https://<?php echo Yii::$app->request->serverName?>/rayon_<?php echo $rayonItem['url']?></loc>
        <lastmod>2021-10-24</lastmod>
        <priority>0.9</priority>
    </url>
<?php endforeach; ?>

<?php if ($service) foreach ($service as $serviceItem) : ?>
    <url>
        <loc>https://<?php echo Yii::$app->request->serverName?>/service_<?php echo $serviceItem['url']?></loc>
        <lastmod>2021-10-24</lastmod>
        <priority>0.9</priority>
    </url>
<?php endforeach; ?>

<?php if ($place) foreach ($place as $placeItem) : ?>
    <url>
        <loc>https://<?php echo Yii::$app->request->serverName?>/place_<?php echo $placeItem['url']?></loc>
        <lastmod>2021-10-24</lastmod>
        <priority>0.9</priority>
    </url>
<?php endforeach; ?>


<?php if ($posts) foreach ($posts as $postItem) : ?>
    <url>
        <loc>https://<?php echo Yii::$app->request->serverName?>/anketa/<?php echo $postItem['url']?></loc>
        <lastmod>2021-10-24</lastmod>
        <priority>0.8</priority>
    </url>
<?php endforeach; ?>

</urlset>
<?php

/* @var $this \yii\web\View */
/* @var $title string */
/* @var $des string */
/* @var $h1 string */
/* @var $posts \frontend\modules\user\models\Posts[] */

$this->title = $title;

Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $des
]);


$result = [];

foreach ($posts as $post) {

    if ( (isset($post['adress']['x']) or isset($post['metro'][0]['x']))  and $post['avatar']) {

        if (isset($post['adress']['x']) and $post['adress']['x']) {

            $tempData = [
                'name' => $post->name,
                'url' => $post->url,
                'img' => $post['avatar']['file'],
                'price' => $post->price,
                'phone' => $post->phone,
                'x' => $post['adress']['x'],
                'y' => $post['adress']['y'],
            ];

        }elseif (isset($post['metro'][0]['x']) and $post['metro'][0]['x']){

            $tempData = [
                'name' => $post->name,
                'url' => $post->url,
                'img' => $post['avatar']['file'],
                'price' => $post->price,
                'phone' => $post->phone,
                'x' => $post['metro'][0]['x'],
                'y' => $post['metro'][0]['y'],
            ];

        }

        if ($tempData) $result[] = $tempData;

    }

}

?>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>

<div class="map-data d-none">
    <?php echo json_encode($result) ?>
</div>

<div class="container karta">

    <h1 class="h1"> <?php echo $h1 ?> </h1>

    <div id="map">
        <img src="/img/spinner.gif" alt="">
    </div>

    <script>

        function create_img(src) {

            return '<img src="' + src + '" class="yandex-map-img">'

        }

        function create_ballon_content(item) {

            return create_img(item.img) + "<br>"
                + "<div class='map-phone'> " + item.phone + " </div>"
                + "<div class='small-red-text'>" + item.price + " р.</div>";

        }

        ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map("map", {
                center: [55.76, 37.64],
                zoom: 10,
            }, {
                searchControlProvider: 'yandex#search'
            });

            var data = JSON.parse($('.map-data').html());

            var result = [];

            var presetName = "twirl#violetIcon";

            data.forEach(function (item) {

                var myGeoObject = new ymaps.GeoObject({
                        geometry: {type: "Point", coordinates: [item.x, item.y]},
                        properties: {
                            clusterCaption: item.name,
                            hintContent: item.name,
                            balloonHeader: item.name,
                            balloonContent: create_ballon_content(item),
                        }
                    },
                    {preset: presetName});

                result.push(myGeoObject);

            })

            var myClusterer0 = new ymaps.Clusterer({preset: "twirl#redClusterIcons", gridSize: 100});

            myClusterer0.add(result);

            myMap.geoObjects.add(myClusterer0);

            $('.karta #map img').remove();

        }


    </script>

</div>
<?php


namespace frontend\widgets;
use frontend\modules\user\models\City;
use frontend\modules\user\models\MassagDlya;
use frontend\modules\user\models\Metro;
use frontend\modules\user\models\Place;
use frontend\modules\user\models\Rayon;
use frontend\modules\user\models\Service;
use yii\base\Widget;
use Yii;

class FilterWidget extends Widget
{

    public $city;

    public function run()
    {
        $this->city = Yii::$app->controller->actionParams['city'];

        $city = Yii::$app->cache->get('city_'.$this->city);

        if ($city === false) {

            $city = City::find()->where(['name' => $this->city])->asArray()->one();

            Yii::$app->cache->set('city_'.$this->city, $city);

        }

        $metro = Metro::getMetro($city['id']);

        $rayon = Rayon::getRayon($city['id']);

        $service = Service::getService();

        $massagDlya = MassagDlya::getData();

        $place = Place::getData();

        return $this->render('filter', [
            'metro' => $metro,
            'rayon' => $rayon,
            'service' => $service,
            'massagDlya' => $massagDlya,
            'place' => $place,
        ]);
    }

}
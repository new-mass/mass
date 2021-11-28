<?php

namespace frontend\widgets;

use frontend\models\forms\FindModel;
use frontend\modules\user\models\City;
use frontend\modules\user\models\Metro;
use frontend\modules\user\models\Rayon;
use frontend\modules\user\models\Service;
use frontend\modules\user\models\MassagDlya;
use frontend\modules\user\models\Place;
use Yii;
use yii\base\Widget;

class BigFilterWidget extends Widget
{

    public $city;

    public function run()
    {

        $metro = false;
        $rayon = false;

        if ($this->city
            and $city = City::getCity($this->city)){

            $metro = Metro::getMetro($city['id']);
            $rayon = Rayon::getRayon($city['id']);

        }

        $service = Service::getService();
        $place = Place::getData();
        $massagDlya = MassagDlya::getData();

        $model = new FindModel();

        return $this->render('big-filter', [
            'model' => $model,
            'metro' => $metro,
            'rayon' => $rayon,
            'service' => $service,
            'place' => $place,
            'massagDlya' => $massagDlya,
        ]);
    }
}
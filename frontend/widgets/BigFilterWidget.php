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

        if ($this->city == 'e-mass') $this->city = 'moskva';

        if ($this->city
            and $city = City::getCity($this->city)){

            $metro = Metro::getMetro($city['id']);
            $rayon = Rayon::getRayon($city['id']);

        }

        $service = Service::getService();
        $place = Place::getData();
        $massagDlya = MassagDlya::getData();

        if ($metro) array_unshift($metro, ['id' => 0, 'value' => 'Выбрать']);
        if ($rayon) array_unshift($rayon, ['id' => 0, 'value' => 'Выбрать']);
        if ($service) array_unshift($service, ['id' => 0, 'value' => 'Выбрать']);
        if ($place) array_unshift($place, ['id' => 0, 'value' => 'Выбрать']);
        if ($massagDlya) array_unshift($massagDlya, ['id' => 0, 'value' => 'Выбрать']);

        $model = new FindModel();

        if (Yii::$app->request->get('FindModel')) $model->load(Yii::$app->request->get());

        $params = Yii::$app->request->get('FindModel');

        return $this->render('big-filter', [
            'model' => $model,
            'metro' => $metro,
            'rayon' => $rayon,
            'service' => $service,
            'place' => $place,
            'massagDlya' => $massagDlya,
            'params' => $params,
        ]);
    }
}
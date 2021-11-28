<?php

namespace frontend\models\forms;

use yii\base\Model;

class FindModel extends Model
{
    public $metro;
    public $rayon;
    public $age;
    public $service;
    public $massagDlya;
    public $price;
    public $place;

    public function rules()
    {
        return [
            [['metro', 'rayon', 'age', 'service', 'massagDlya', 'price', 'place'], 'safe']
        ];
    }

}
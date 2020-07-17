<?php


namespace frontend\models\forms;
use yii\base\Model;

class SearchForm extends Model
{

    public $name;

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }
}
<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string|null $value
 * @property string|null $name
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'name' => 'Name',
        ];
    }

    public static function getCity($city_name)
    {
        $city = Yii::$app->cache->get('city_'.$city_name);

        if ($city === false) {

            $city = City::find()->where(['name' => $city_name])->asArray()->one();

            Yii::$app->cache->set('city_'.$city_name, $city);

        }

        return $city;

    }

}

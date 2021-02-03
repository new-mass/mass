<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "rayon".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $value
 * @property int|null $city_id
 */
class Rayon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rayon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id'], 'integer'],
            [['url', 'value'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'value' => 'Value',
            'city_id' => 'City ID',
        ];
    }

    public static function getRayon($city_id)
    {

        $rayon = Yii::$app->cache->get('rayon_'.$city_id);

        if ($rayon === false) {

            $rayon = Rayon::find()->where(['city_id' => $city_id])->asArray()->all();

            Yii::$app->cache->set('rayon_'.$city_id, $rayon);

        }

        return $rayon;

    }

}

<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "metro".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $value
 * @property int|null $city_id
 */
class Metro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'value'], 'string', 'max' => 40],
            [['city_id'], 'integer'],
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
        ];
    }

    public static function getMetro($city_id)
    {

        $tag = Yii::$app->cache->get('metro_'.$city_id);

        if ($tag === false) {

            $tag = Metro::find()->where(['city_id' => $city_id])->orderBy('value')->asArray()->all();

            Yii::$app->cache->set('metro_'.$city_id, $tag);

        }

        return $tag;

    }

}

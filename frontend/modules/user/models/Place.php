<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $value
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
        ];
    }

    public static function getData()
    {
        $data = Yii::$app->cache->get('place');
;
        if ($data === false) {

            $data = Place::find()->asArray()->all();

            Yii::$app->cache->set('place', $data);

        }

        return $data;
    }

}

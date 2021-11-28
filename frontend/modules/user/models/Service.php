<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $value
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
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

    public static function getService()
    {

        $rayon = Yii::$app->cache->get('service');

        if ($rayon === false) {

            $rayon = Service::find()->asArray()->orderBy('value')->all();

            Yii::$app->cache->set('service', $rayon);

        }

        return $rayon;

    }
}

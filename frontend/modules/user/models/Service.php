<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $value
 * @property integer $status
 */
class Service extends \yii\db\ActiveRecord
{

    const STATUS_HIDE = 0;
    const STATUS_OPEN = 1;

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

    public static function getService($all = false)
    {

        $rayon = Yii::$app->cache->get('service');

        if ($rayon === false) {

            $rayon = Service::find();
            if ($all) $rayon = $rayon->where(['status' => self::STATUS_OPEN]);
            $rayon = $rayon->asArray()->orderBy('value')->all();

            Yii::$app->cache->set('service', $rayon);

        }

        return $rayon;

    }
}

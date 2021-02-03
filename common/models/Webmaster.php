<?php

namespace common\models;

use frontend\modules\user\models\City;
use Yii;

/**
 * This is the model class for table "webmaster".
 *
 * @property int $id
 * @property int|null $city_id
 * @property string|null $tag
 */
class Webmaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'webmaster';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id'], 'integer'],
            [['tag'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'tag' => 'Tag',
        ];
    }

    public static function getTag($city_id)
    {

        $tag = Yii::$app->cache->get('webmaster_tag_'.$city_id);

        if ($tag === false) {

            $tag = Webmaster::find()->where(['city_id' => $city_id])->select('tag')->asArray()->one();

            Yii::$app->cache->set('webmaster_tag_'.$city_id, $tag);

        }

        return $tag;

    }

}

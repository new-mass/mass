<?php

namespace common\models;

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
}

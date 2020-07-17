<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "massag_dlya".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $value
 */
class MassagDlya extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'massag_dlya';
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
}

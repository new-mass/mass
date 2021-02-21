<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "messanger".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $img
 */
class Messanger extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messanger';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 25],
            [['img'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'img' => 'Img',
        ];
    }
}

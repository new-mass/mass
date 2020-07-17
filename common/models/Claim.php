<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "claim".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $text
 * @property integer $timestamp
 */
class Claim extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'claim';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 52],
            [['text'], 'string', 'max' => 255],
            [['timestamp', 'status'], 'integer'],
            [['timestamp', 'status'], 'safe'],
            [['name', 'email', 'text'] , 'required']
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
            'email' => 'Email',
            'text' => 'Text',
            'timestamp' => 'timestamp',
        ];
    }
}

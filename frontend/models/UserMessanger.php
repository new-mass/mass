<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_messanger".
 *
 * @property int|null $prop_id
 * @property int|null $user_id
 */
class UserMessanger extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_messanger';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prop_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'prop_id' => 'Prop ID',
            'user_id' => 'User ID',
        ];
    }
}

<?php

namespace frontend\modules\user\models\relation;

use Yii;

/**
 * This is the model class for table "user_metro".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $prop_id
 */
class UserMetro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_metro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'prop_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'prop_id' => 'Prop ID',
        ];
    }
}

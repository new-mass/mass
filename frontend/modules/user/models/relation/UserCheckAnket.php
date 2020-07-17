<?php

namespace frontend\modules\user\models\relation;

use Yii;

/**
 * This is the model class for table "user_check_anket".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $prop_id ид способа проверки
 */
class UserCheckAnket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_check_anket';
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
            'user_id' => 'Post ID',
            'prop_id' => 'Check ID',
        ];
    }
}

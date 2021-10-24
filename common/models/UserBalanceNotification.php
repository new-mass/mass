<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_balance_notification".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $last_notification_send
 * @property int|null $is_send_notification 0 не отправлять 1 отправлять
 * @property int|null $balance_event сумма о которой уже нужно уведомить пользователя
 *
 * @property User $user
 */
class UserBalanceNotification extends \yii\db\ActiveRecord
{

    const NOTIFICATION_OPEN = 1;
    const NOTIFICATION_CLOSE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_balance_notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'last_notification_send', 'is_send_notification', 'balance_event'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'last_notification_send' => 'Last Notification Send',
            'is_send_notification' => 'Is Send Notification',
            'balance_event' => 'Balance Event',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

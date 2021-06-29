<?php

namespace common\models;

use Yii;
use frontend\modules\user\models\Posts;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "check_photo_request".
 *
 * @property int $id
 * @property int|null $post_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $status 0 заявка новая 1 заявка просмотрена
 *
 * @property Posts $post
 */
class CheckPhotoRequest extends \yii\db\ActiveRecord
{

    const REQUEST_CHECK = 1;
    const REQUEST_NOT_CHECK = 0;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    self::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'check_photo_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::class, 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::class, ['id' => 'post_id']);
    }
}

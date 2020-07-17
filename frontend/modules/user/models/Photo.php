<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $avatar
 * @property string|null $file
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'avatar'], 'integer'],
            [['file'], 'string', 'max' => 255],
        ];
    }


    public function unsetAvatarStatus(){

        Photo::updateAll(['avatar' => 0], ['user_id' => $this->user_id]);

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'avatar' => 'Avatar',
            'file' => 'File',
        ];
    }
}

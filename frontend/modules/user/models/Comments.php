<?php

namespace frontend\modules\user\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $post_id
 * @property string|null $name
 * @property string|null $text
 * @property int|null $mark
 * @property int|null $status
 * @property int|null $old_id
 * @property int|null $city_id
 *
 * @property Comments $parent
 * @property Comments[] $comments
 * @property Posts $post
 */
class Comments extends \yii\db\ActiveRecord
{
    const COMMENT_ON_MODERETION = 0;
    const COMMENT_ON_PUBLICATION = 1;
    const COMMENT_HIDE = 2;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'post_id', 'mark', 'status', 'old_id', 'city_id'], 'integer'],
            [['name'], 'string', 'max' => 25],
            [['text'], 'string', 'max' => 255],
            [['text', 'name'], 'required'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comments::class, 'targetAttribute' => ['parent_id' => 'id']],
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
            'parent_id' => 'Parent ID',
            'post_id' => 'Post ID',
            'name' => 'Имя',
            'text' => 'Комментарий',
            'mark' => 'Оценка',
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Comments::class, ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::class, ['parent_id' => 'id']);
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

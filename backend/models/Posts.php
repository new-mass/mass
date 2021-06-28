<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property int|null $city_id
 * @property int|null $user_id
 * @property int|null $tarif_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $sorting
 * @property string|null $name
 * @property string|null $phone
 * @property int|null $work_time
 * @property int|null $age
 * @property int|null $breast
 * @property int|null $ves
 * @property int|null $rost
 * @property int|null $price
 * @property int|null $price_2_hour
 * @property string|null $about
 * @property int|null $status
 * @property string|null $url
 * @property int|null $pay_time Время до каторого анкета оплачена
 *
 * @property Comments[] $comments
 * @property PhoneView[] $phoneViews
 * @property PostView[] $postViews
 * @property SingleViewPost[] $singleViewPosts
 */
class Posts extends \frontend\modules\user\models\Posts
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'user_id', 'tarif_id', 'created_at', 'check_photo_status', 'updated_at', 'sorting', 'work_time', 'age', 'breast', 'ves', 'rost', 'price', 'price_2_hour', 'status', 'pay_time'], 'integer'],
            [['about'], 'string'],
            [['name'], 'string', 'max' => 80],
            [['phone'], 'string', 'max' => 20],
            [['url'], 'string', 'max' => 75],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'user_id' => 'User ID',
            'tarif_id' => 'Tarif ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'sorting' => 'Sorting',
            'name' => 'Name',
            'phone' => 'Phone',
            'work_time' => 'Work Time',
            'age' => 'Age',
            'breast' => 'Breast',
            'ves' => 'Ves',
            'rost' => 'Rost',
            'price' => 'Price',
            'price_2_hour' => 'Price 2 Hour',
            'about' => 'About',
            'status' => 'Status',
            'url' => 'Url',
            'pay_time' => 'Pay Time',
            'check_photo_status' => 'Проверочное фото',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[PhoneViews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneViews()
    {
        return $this->hasMany(PhoneView::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[PostViews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostViews()
    {
        return $this->hasMany(PostView::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[SingleViewPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSingleViewPosts()
    {
        return $this->hasMany(SingleViewPost::className(), ['post_id' => 'id']);
    }
}

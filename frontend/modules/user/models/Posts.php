<?php

namespace frontend\modules\user\models;

use common\models\SingleViewPost;
use frontend\modules\user\models\relation\UserCheckAnket;
use frontend\modules\user\models\relation\UserComfort;
use frontend\modules\user\models\relation\UserMassagDlya;
use frontend\modules\user\models\relation\UserMetro;
use frontend\modules\user\models\relation\UserPlace;
use frontend\modules\user\models\relation\UserPol;
use frontend\modules\user\models\relation\UserRayon;
use frontend\modules\user\models\relation\UserService;
use frontend\modules\user\models\relation\UserWorckTime;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property int|null $city_id
 * @property int|null $user_id
 * @property int|null $tarif_id
 * @property int|null $created_at
 * @property int|null $sorting
 * @property string|null $name
 * @property string|null $phone
 * @property int|null $work_time
 * @property int|null $age
 * @property int|null $rost
 * @property int|null $price
 * @property int|null $price_2_hour
 * @property string|null $about
 * @property int|null $status
 * @property string|null $url
 * @property integer $old_id
 * @property integer $old_user_id
 * @property integer $breast
 * @property integer $ves
 * @property string $old_url
 */
class Posts extends \yii\db\ActiveRecord
{
    const POST_ON_MODERETION = 0;
    const POST_ON_PUBLICATION = 1;
    const POST_DONT_PUBLICATION = 2;
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
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'user_id', 'tarif_id', 'created_at', 'sorting', 'work_time', 'age', 'rost', 'price','ves','breast', 'price_2_hour', 'status'], 'integer'],
            [['name'], 'string', 'max' => 80],
            [['age'], 'integer', 'min' => 18],
            [['name', 'phone', 'price'], 'required'],
            [['phone'], 'string', 'max' => 20],
            [['avatar'], 'safe'],
            [['about'], 'string' , 'max' => 1200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tarif_id' => 'Тариф',
            'created_at' => 'Created At',
            'sorting' => 'Sorting',
            'name' => 'Имя',
            'phone' => 'Номер телефона',
            'work_time' => 'Опыт работы',
            'age' => 'Возраст',
            'rost' => 'Рост',
            'price' => 'Цена за сеанс 1 час',
            'price_2_hour' => 'Цена за сеанс 2 часа',
            'breast' => 'Размер груди',
            'ves' => 'Вес',
        ];
    }

    public function getComments()
    {
        return $this->hasMany(Comments::class, ['post_id' => 'id'])->where(['status' => 1]);
    }
    public function getViewsOnListing()
    {
        return $this->hasOne(PostView::class, ['post_id' => 'id']);
    }
    public function getViewsOnSingle()
    {
        return $this->hasOne(SingleViewPost::class, ['post_id' => 'id']);
    }
    public function getViewsPhone()
    {
        return $this->hasOne(PhoneView::class, ['post_id' => 'id']);
    }

    public function getAvatar()
    {
        return $this->hasOne(Photo::class, ['user_id' => 'id' ])->where(['avatar' => 1]);
    }

    public function setAvatar()
    {
        return true;
    }

    public function getGallery()
    {
        return $this->hasMany(Photo::class, ['user_id' => 'id' ])->where(['avatar' => 0]);
    }

    public function getServiceRelation(){

        return $this->hasMany(UserService::class, [ 'user_id' => 'id']);

    }

    public function getService(){

        return $this->hasMany(Service::class, ['id' => 'prop_id'])->via('serviceRelation');

    }
    public function getComfortRelation(){

        return $this->hasMany(UserComfort::class, [ 'user_id' => 'id']);

    }

    public function getComfort(){

        return $this->hasMany(Comfort::class, ['id' => 'prop_id'])->via('comfortRelation');

    }

    public function getMassagDlyaRelation(){

        return $this->hasMany(UserMassagDlya::class, [ 'user_id' => 'id']);

    }

    public function getMassagDlya(){

        return $this->hasMany(MassagDlya::class, ['id' => 'prop_id'])->via('massagDlyaRelation');

    }

    public function getPlaceRelation(){

        return $this->hasMany(UserPlace::class, [ 'user_id' => 'id']);

    }

    public function getPlace(){

        return $this->hasMany(Place::class, ['id' => 'prop_id'])->via('placeRelation');

    }

    public function getCheckRelation(){

        return $this->hasMany(UserCheckAnket::class, [ 'user_id' => 'id']);

    }

    public function getCheck(){

        return $this->hasMany(CheckAnket::class, ['id' => 'prop_id'])->via('checkRelation');

    }

    public function getRayonRelation(){

        return $this->hasMany(UserRayon::class, [ 'user_id' => 'id']);

    }

    public function getRayon(){

        return $this->hasMany(Rayon::class, ['id' => 'prop_id'])->via('rayonRelation');

    }

    public function getMetroRelation(){

        return $this->hasMany(UserMetro::class, [ 'user_id' => 'id']);

    }

    public function getMetro(){

        return $this->hasMany(Metro::class, ['id' => 'prop_id'])->via('metroRelation');

    }



    public function getWorkTime(){

        return $this->hasOne(UserWorckTime::class, ['post_id' => 'id']);

    }

    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }



    public function save($runValidation = true, $attributeNames = null)
    {

        if ($this->isNewRecord){
            $this->user_id = Yii::$app->user->id;
            $this->sorting = time();
        }


        return parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
    }

    public function saveOriginalMethod($runValidation = true, $attributeNames = null)
    {
        return parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
    }
}

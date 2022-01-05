<?php

namespace frontend\modules\user\models;

use common\models\SingleViewPost;
use frontend\models\Adress;
use frontend\models\Messanger;
use frontend\models\UserMessanger;
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
 * @property integer $video_sort
 * @property integer $check_photo_status
 * @property integer $type
 */
class Posts extends \yii\db\ActiveRecord
{
    const POST_ON_MODERETION = 0;
    const POST_ON_PUBLICATION = 1;
    const POST_DONT_PUBLICATION = 2;

    const PHOTO_NOT_CHECK = 0;
    const PHOTO_CHECK = 1;

    const TYPE_INDI = 0;
    const TYPE_SALON = 1;

    const POSTS_HIDE = 1;
    const POSTS_SHOW = 0;


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

    public static function getOrder()
    {
        return 'tarif_id desc, check_photo_status desc, video_sort desc, sorting desc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'user_id', 'tarif_id', 'created_at', 'sorting', 'work_time', 'age',
                'rost', 'price','ves','breast', 'price_2_hour', 'status', 'video_sort', 'check_photo_status', 'type'], 'integer'],
            [['name'], 'string', 'max' => 80],
            [['age'], 'integer', 'min' => 18],
            [['name', 'phone', 'price'], 'required'],
            [['phone'], 'string', 'max' => 20],
            [['avatar','video'], 'safe'],
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
            'video' => 'Видео',
            'type' => 'Тип анкеты',
        ];
    }

    public function getAdress()
    {
        return $this->hasOne(Adress::class, ['post_id' => 'id']);
    }

    public function getComments()
    {
        return $this->hasMany(Comments::class, ['post_id' => 'id'])->where(['status' => 1]);
    }
    public function getAllComments()
    {
        return $this->hasMany(Comments::class, ['post_id' => 'id'])->where(['in', 'status', [1,2]]);
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

    public function getVideo()
    {
        return $this->hasOne(Photo::class, ['user_id' => 'id' ])->where(['type' => Photo::TYPE_VIDEO]);
    }
    public function getCheckPhoto()
    {
        return $this->hasOne(Photo::class, ['user_id' => 'id' ])->where(['type' => Photo::CHECK_PHOTO]);
    }
    public function setVideo()
    {
        return true;
    }

    public function setAvatar()
    {
        return true;
    }

    public function getGallery()
    {
        return $this->hasMany(Photo::class, ['user_id' => 'id' ])
            ->where(['avatar' => 0, 'type' => Photo::TYPE_PHOTO])->orderBy('id DESC');
    }

    public function getServiceRelation(){

        return $this->hasMany(UserService::class, [ 'user_id' => 'id']);

    }

    public function getService(){

        return $this->hasMany(Service::class, ['id' => 'prop_id'])->via('serviceRelation')->cache(3600 * 365);

    }

    public function getMessRelation(){

        return $this->hasMany(UserMessanger::class, [ 'user_id' => 'id']);

    }

    public function getMess(){

        return $this->hasMany(Messanger::class, ['id' => 'prop_id'])->via('messRelation')->cache(3600 * 365);

    }
    public function getComfortRelation(){

        return $this->hasMany(UserComfort::class, [ 'user_id' => 'id']);

    }

    public function getComfort(){

        return $this->hasMany(Comfort::class, ['id' => 'prop_id'])->via('comfortRelation')->cache(3600 * 365);

    }

    public function getMassagDlyaRelation(){

        return $this->hasMany(UserMassagDlya::class, [ 'user_id' => 'id']);

    }

    public function getMassagDlya(){

        return $this->hasMany(MassagDlya::class, ['id' => 'prop_id'])->via('massagDlyaRelation')->cache(3600 * 365);

    }

    public function getPlaceRelation(){

        return $this->hasMany(UserPlace::class, [ 'user_id' => 'id']);

    }

    public function getPlace(){

        return $this->hasMany(Place::class, ['id' => 'prop_id'])->via('placeRelation')->cache(3600 * 365);

    }

    public function getCheckRelation(){

        return $this->hasMany(UserCheckAnket::class, [ 'user_id' => 'id']);

    }

    public function getCheck(){

        return $this->hasMany(CheckAnket::class, ['id' => 'prop_id'])->via('checkRelation')->cache(3600 * 365);

    }

    public function getRayonRelation(){

        return $this->hasMany(UserRayon::class, [ 'user_id' => 'id']);

    }

    public function getRayon(){

        return $this->hasMany(Rayon::class, ['id' => 'prop_id'])->via('rayonRelation')->cache(3600 * 365);

    }

    public function getMetroRelation(){

        return $this->hasMany(UserMetro::class, [ 'user_id' => 'id']);

    }

    public function getMetro(){

        return $this->hasMany(Metro::class, ['id' => 'prop_id'])->via('metroRelation')->cache(3600 * 365);

    }



    public function getWorkTime(){

        return $this->hasOne(UserWorckTime::class, ['post_id' => 'id']);

    }

    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id'])->cache(3600 * 365 * 24);
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

    public static function getPostByUrl($url, $city_id)
    {

        $post = Posts::find()->where(['url' => $url, 'city_id' => $city_id])
            ->with('avatar')
            ->with('gallery')
            ->with('video')
            ->with('service')
            ->with('massagDlya')
            ->with('place')
            ->with('check')
            ->with('workTime')
            ->with('rayon')
            ->with('metro')
            ->with('comments')
            ->with('comfort')
            ->with('mess')
            ->with('adress')
            ->andWhere(['hide' => Posts::POSTS_SHOW])
            ->limit(1)
            ->asArray()->one();

        return $post;
        
    }
    
}

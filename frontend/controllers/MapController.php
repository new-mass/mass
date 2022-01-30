<?php

namespace frontend\controllers;

use frontend\components\helpers\PageHelper;
use frontend\components\helpers\PostOrderHelper;
use frontend\models\PageMeta;
use frontend\modules\user\models\City;
use frontend\modules\user\models\Posts;
use yii\web\Controller;
use Yii;

class MapController extends Controller
{
    public function actionIndex($city = 'moskva')
    {
        if ($city == 'e-mass') $city = 'moskva';
        $uri = PageHelper::cropUriParams(Yii::$app->request->url);

        $city_name = $city;

        $city = Yii::$app->cache->get('city_'.$city_name);

        if ($city === false) {

            $city = City::find()->where(['name' => $city_name])->asArray()->one();

            Yii::$app->cache->set('city_'.$city_name, $city);

        }

        $meta = Yii::$app->cache->get('meta_'.$city_name.'_'.$uri);

        if ($meta === false) {

            $meta = PageMeta::find()->where(['page_name' => $uri, 'city_id' =>$city['id']])->asArray()->one();

            Yii::$app->cache->set('meta_'.$city_name.'_'.$uri, $meta );

        }

        $posts = Posts::find()
            ->with('avatar')
            ->select('url, name, price, phone, id')
            ->with('adress')
            ->with('metro')
            ->all();

        return $this->render('index' , [
            'posts' => $posts,
            'title' => $meta['title'],
            'des' => $meta['des'],
            'h1' => $meta['h1'],
            'city' => $city,
        ]);
    }
}
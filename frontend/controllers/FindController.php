<?php

namespace frontend\controllers;

use frontend\modules\user\models\City;
use frontend\modules\user\models\relation\UserMassagDlya;
use frontend\modules\user\models\relation\UserMetro;
use frontend\modules\user\models\Posts;
use frontend\modules\user\models\relation\UserService;
use frontend\modules\user\models\relation\UserRayon;
use frontend\modules\user\models\relation\UserPlace;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class FindController extends Controller
{

    public function actionIndex($city = 'moskva')
    {

        $this->enableCsrfValidation = false;

        $params = Yii::$app->request->get('FindModel');

        $city = City::getCity($city);

        $ids = array();

        $filter = false;

        if ($params['metro']) {

            $filter = true;

            $id = UserMetro::find()->where(['prop_id' => $params['metro']])->select('user_id')->asArray()->all();

            if ($id) {

                $result = ArrayHelper::getColumn($id, 'user_id');

                if (!empty($ids)) {

                    $ids = array_intersect($ids, $result);

                } else {

                    $ids = $result;

                }

            }

            if (empty($id)) {
                $ids = [
                    '0' => 0
                ];
            }

        }

        if ($params['rayon']) {

            $filter = true;

            $id = UserRayon::find()->where(['prop_id' => $params['rayon']])->select('user_id')->asArray()->all();

            if ($id) {

                $result = ArrayHelper::getColumn($id, 'user_id');

                if (!empty($ids)) {

                    $ids = array_intersect($ids, $result);

                } else {

                    $ids = $result;

                }

            }

            if (empty($result)) {
                $ids = [
                    '0' => 0
                ];
            }

        }

        if ($params['service']) {

            $filter = true;

            $id = UserService::find()->where(['prop_id' => $params['service']])
                ->select('user_id')->asArray()->all();

            if ($id) {

                $result = ArrayHelper::getColumn($id, 'user_id');

                if (!empty($ids)) {

                    $ids = array_intersect($ids, $result);

                } else {

                    $ids = $result;

                }

            }

            if (empty($result)) {
                $ids = [
                    '0' => 0
                ];
            }

        }

        if ($params['place']) {

            $filter = true;

            $id = UserPlace::find()->where(['prop_id' => $params['place']])
                ->select('user_id')->asArray()->all();

            if ($id) {

                $result = ArrayHelper::getColumn($id, 'user_id');

                if (!empty($ids)) {

                    $ids = array_intersect($ids, $result);

                } else {

                    $ids = $result;

                }

            }

            if (empty($result)) {
                $ids = [
                    '0' => 0
                ];
            }

        }

        if ($params['massagDlya']) {

            $filter = true;

            $id = UserMassagDlya::find()
                ->where(['prop_id' => $params['place']])
                ->select('user_id')
                ->asArray()
                ->all();

            if ($id) {

                $result = ArrayHelper::getColumn($id, 'user_id');

                if (!empty($ids)) {

                    $ids = array_intersect($ids, $result);

                } else {

                    $ids = $result;

                }

            }

            if (empty($result)) {
                $ids = [
                    '0' => 0
                ];
            }

        }

        $posts = Posts::find()->andWhere(['city_id' => $city['id']])->orderBy(Posts::getOrder());

            if ($ids) $posts = $posts->andWhere(['in', 'id', $ids]);

            $posts = $posts->andWhere(['>=' , 'age', $params['min_age']])
            ->andWhere(['<=' , 'age', $params['max_age']])
            ->andWhere(['>=' , 'price', $params['min_price']])
            ->andWhere(['<=' , 'price', $params['max_price']])
        ;

        $posts = $posts
            ->with('avatar', 'metro', 'rayon', 'video', 'gallery')
            ->andWhere(['status' => Posts::POST_ON_PUBLICATION])
            ->all();

        $title  = 'Поиск';
        $des    = 'Поиск';
        $h1     = 'Поиск';

        return $this->render('index', [
            'posts' => $posts,
            'city' => $city,
            'param' => Yii::$app->request->url,
            'title' => $title,
            'des' => $des,
            'h1' => $h1,
        ]);

    }

}
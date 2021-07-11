<?php


namespace frontend\components\helpers;

use frontend\modules\user\models\Posts;
use yii\helpers\ArrayHelper;
use frontend\modules\user\models\City;
use common\models\FilterParams;

class QueryParamsHelper
{
    public static function getParams($params ,$city, $limit = 12, $offset = 0)
    {

        if (strpos($params, '/?page')) $params = strstr($params, '/?page', true);

        $params = explode('/', $params);

        $filter_params = FilterParams::find()->asArray()->all();

        $ids = array();

        $query_params = array();
        $bread_crumbs_params = array();

        $stem = 0;

        //Перебираем параметры
        foreach ($params as $value) {

            foreach ($filter_params as $filter_param){

                $result_id_array = array();

                if (strstr($value, $filter_param['url'])) {

                    $className = $filter_param['class_name'];

                    $classRelationName = $filter_param['relation_class'];

                    $url = self::prepareUrl($filter_param['url'],$value );

                    if ($url and $className) {

                        $id = $className::find()->where(['url' => $url])->asArray()->one();

                        if ($id and $classRelationName) {

                            if ($ids = $classRelationName::find()->select('user_id')->where([$filter_param['column_param_name'] => $id['id']])->asArray()->all()){

                                return Posts::find()->where(['in', 'id', ArrayHelper::getColumn($ids, 'user_id')])
                                    ->andWhere(['city_id' => $city['id']])
                                    ->with('avatar')
                                    ->with('metro')
                                    ->with('rayon')
                                    ->with('video')
                                    ->orderBy('tarif_id desc, check_photo_status desc, video_sort desc, sorting desc')
                                    ->andWhere(['status' => Posts::POST_ON_PUBLICATION])
                                    ->limit($limit)
                                    ->offset($offset)
                                   ;

                            }

                            return false;

                        }

                    }

                }

            }

            if (strstr($value, 'price')) {

                $url = str_replace('price_', '', $value);

                $price_params = array();

                if ($url == 'do-2000') $price_params[] = ['<', 'price', 2000];

                if ($url == 'ot-2000-do-3000') {
                    $price_params[] = ['>=', 'price', 2000];
                    $price_params[] = ['<=', 'price', 2999];
                }

                if ($url == 'ot-3000') {
                    $price_params[] = ['>=', 'price', 3001];
                }

                $id = Posts::find();

                foreach ($price_params as $price_param) {
                    $id->andWhere($price_param);
                }

                return $id->andWhere(['status' => 1])
                    ->andWhere(['city_id' => $city['id']])
                    ->with('avatar')
                    ->with('metro')
                    ->with('video')
                    ->limit($limit)
                    ->offset($offset)
                    ->with('rayon')->orderBy('tarif_id desc, check_photo_status desc, video_sort desc, sorting desc');

            }

            if (strstr($value, 'age')) {

                $url = str_replace('age_', '', $value);

                $price_params = array();

                if ($url == 'ot-18-do-20-let') {
                    $price_params[] = ['>=', 'age', 18];
                    $price_params[] = ['<=', 'age', 20];
                }

                if ($url == 'ot-21-do-25-let') {
                    $price_params[] = ['>=', 'age', 21];
                    $price_params[] = ['<=', 'age', 25];
                }

                if ($url == 'ot-26-do-30-let') {
                    $price_params[] = ['>=', 'age', 26];
                    $price_params[] = ['<=', 'age', 30];
                }

                if ($url == 'ot-31-do-40-let') {
                    $price_params[] = ['>=', 'age', 31];
                    $price_params[] = ['<=', 'age', 40];
                }

                if ($url == 'ot-40-do-50-let') {
                    $price_params[] = ['>=', 'age', 40];
                    $price_params[] = ['<=', 'age', 50];
                }

                if ($url == 'starshe-51-goda') {
                    $price_params[] = ['>=', 'age', 51];
                }


                $id = Posts::find();

                foreach ($price_params as $price_param) {
                    $id->andWhere($price_param);
                }

                return $id->andWhere(['status' => 1])->with('avatar')->with('metro')->limit($limit)
                    ->andWhere(['city_id' => $city['id']])
                    ->with('video')
                    ->offset($offset)
                    ->with('rayon')->orderBy('tarif_id desc, check_photo_status desc, video_sort desc, sorting desc');

            }

        }

    }

    public static function prepareUrl($url, $value){

        if ($url == $value) return $url;

        return str_replace($url. '_', '', $value);


    }
}
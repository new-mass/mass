<?php


namespace frontend\components\helpers;

use frontend\modules\user\models\Photo;
use frontend\modules\user\models\Posts;
use yii\helpers\ArrayHelper;
use frontend\modules\user\models\City;
use common\models\FilterParams;
use Yii;

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

                            if (!empty($ids)) {

                                $relationsIds = ArrayHelper::getColumn($classRelationName::find()
                                    ->where([$filter_param['column_param_name'] => $id['id']])
                                    ->asArray()->all(), 'user_id');

                                $ids = array_intersect($ids, $relationsIds) ;

                            } else {

                                $ids = ArrayHelper::getColumn($classRelationName::find()
                                    ->where([$filter_param['column_param_name'] => $id['id']])
                                    ->asArray()->all(), 'user_id');

                            }

                            if (empty($ids)) {
                                $ids[] = [
                                    '0' => 0
                                ];
                            }

                        }

                    }

                }

            }

            if (strstr($value, 'price')) {

                $url = str_replace('price_', '', $value);

                $price_params = array();

                if ($url == 'do-2000') {

                    $price_params[] = ['<', 'price', 2000];

                    Yii::$app->params['breadcrumbs'][] = array(
                        'label'=> 'Цена до 2000',
                    );

                }

                if ($url == 'ot-2000-do-3000') {

                    Yii::$app->params['breadcrumbs'][] = array(
                        'label'=> 'Цена от 2000 до 3000',
                    );

                    $price_params[] = ['>=', 'price', 2000];
                    $price_params[] = ['<=', 'price', 2999];
                }

                if ($url == 'ot-3000') {

                    Yii::$app->params['breadcrumbs'][] = array(
                        'label'=> 'Цена от 3000',
                    );

                    $price_params[] = ['>=', 'price', 3001];
                }

                foreach ($price_params as $price_param) {

                    $query_params[] = $price_param;

                }

            }

            if (strstr($value, 'age')) {

                $url = str_replace('age_', '', $value);

                $price_params = array();

                if ($url == 'ot-18-do-20-let') {

                    Yii::$app->params['breadcrumbs'][] = array(
                        'label'=> 'Возраст от 18 до 20',
                    );

                    $price_params[] = ['>=', 'age', 18];
                    $price_params[] = ['<=', 'age', 20];
                }

                if ($url == 'ot-21-do-25-let') {

                    Yii::$app->params['breadcrumbs'][] = array(
                        'label'=> 'Возраст от 21 до 25',
                    );

                    $price_params[] = ['>=', 'age', 21];
                    $price_params[] = ['<=', 'age', 25];
                }

                if ($url == 'ot-26-do-30-let') {

                    Yii::$app->params['breadcrumbs'][] = array(
                        'label'=> 'Возраст от 26 до 30',
                    );

                    $price_params[] = ['>=', 'age', 26];
                    $price_params[] = ['<=', 'age', 30];
                }

                if ($url == 'ot-31-do-40-let') {

                    Yii::$app->params['breadcrumbs'][] = array(
                        'label'=> 'Возраст от 31 до 40',
                    );

                    $price_params[] = ['>=', 'age', 31];
                    $price_params[] = ['<=', 'age', 40];
                }

                if ($url == 'ot-40-do-50-let') {

                    Yii::$app->params['breadcrumbs'][] = array(
                        'label'=> 'Возраст от 40 до 50',
                    );

                    $price_params[] = ['>=', 'age', 40];
                    $price_params[] = ['<=', 'age', 50];
                }

                if ($url == 'starshe-51-goda') {

                    Yii::$app->params['breadcrumbs'][] = array(
                        'label'=> 'Возраст от 51',
                    );

                    $price_params[] = ['>=', 'age', 51];
                }

                foreach ($price_params as $price_param) {

                    $query_params[] = $price_param;

                }

            }

            if (strstr($value, 'video')) {

                Yii::$app->params['breadcrumbs'][] = array(
                    'label'=> 'Видео',
                );

                $postIds = Photo::find()
                    ->where(['type' => Photo::TYPE_VIDEO])
                    ->select('user_id')
                    ->asArray()->all();

                $id = Posts::find();

                return $id->andWhere(['status' => 1])
                    ->with('avatar')
                    ->with('metro')
                    ->with('gallery')
                    ->limit($limit)
                    ->andWhere(['city_id' => $city['id']])
                    ->andWhere(['in', 'id', ArrayHelper::getColumn($postIds, 'id')])
                    ->with('video')
                    ->offset($offset)
                    ->with('rayon')->orderBy('tarif_id desc, check_photo_status desc, video_sort desc, sorting desc');

            }

        }

        if ($ids) {

            $query_params[] = ['in', 'id', $ids];

        }

        $posts = Posts::find();

        foreach ($query_params as $query_param){

            $posts = $posts->andWhere($query_param);

        }

        return $posts->andWhere(['status' => 1])
            ->andWhere(['city_id' => $city['id']])
            ->with('avatar')
            ->with('metro')
            ->with('video')
            ->with('gallery')
            ->limit($limit)
            ->offset($offset)
            ->with('rayon')->orderBy('tarif_id desc, check_photo_status desc, video_sort desc, sorting desc');


    }

    public static function prepareUrl($url, $value){

        if ($url == $value) return $url;

        return str_replace($url. '_', '', $value);


    }
}
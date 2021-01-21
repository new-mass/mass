<?php
namespace frontend\modules\user\widgets;

use yii\base\Widget;
use Yii;

class UserSideBarWidget extends Widget
{

    public $posts;

    public function run()
    {

        $totalView = 0;
        $dayView = 0;

        if (is_array($this->posts)){

            foreach ($this->posts as $item){

                if (isset($item['viewsOnListing']['count'])) $totalView = $totalView + $item['viewsOnListing']['count'];
                if (isset($item['viewsOnSingle']['count'])) $totalView = $totalView + $item['viewsOnSingle']['count'];

                $dayView = $dayView + Yii::$app->cache->get(Yii::$app->params['view_today_cache_key'] . '_' . date('d') . '_' . $item['id']) ?: 0;
                $dayView = $dayView + Yii::$app->cache->get(Yii::$app->params['single_view_today_cache_key'] . '_' . date('d') . '_' . $item['id']) ?: 0;

            }

        }

        return $this->render('user-sidebar' , [
                    'posts' => $this->posts,
                'totalView' => $totalView,
                 'dayView' => $dayView
        ]);
    }
}
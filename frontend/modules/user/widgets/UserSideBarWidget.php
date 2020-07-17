<?php
namespace frontend\modules\user\widgets;

use yii\base\Widget;

class UserSideBarWidget extends Widget
{
    public function run()
    {
        return $this->render('user-sidebar');
    }
}
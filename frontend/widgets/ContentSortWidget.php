<?php

namespace frontend\widgets;

use yii\base\Widget;

class ContentSortWidget extends Widget
{
    public function run()
    {
        return $this->render('sort');
    }
}
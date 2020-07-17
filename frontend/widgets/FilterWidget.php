<?php


namespace frontend\widgets;
use yii\base\Widget;

class FilterWidget extends Widget
{
    public function run()
    {
        return $this->render('filter');
    }

}
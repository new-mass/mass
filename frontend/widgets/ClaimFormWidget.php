<?php


namespace frontend\widgets;

use yii\base\Widget;

class ClaimFormWidget extends Widget
{
    public function run()
    {
        $claimForm = new \frontend\models\forms\ClaimForm();

        return $this->render('claim_form', [
            'claimForm' => $claimForm
        ] );
    }
}
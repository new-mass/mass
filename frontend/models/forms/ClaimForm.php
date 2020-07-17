<?php


namespace frontend\models\forms;

use common\models\Claim;
use yii\base\Model;

class ClaimForm extends Model
{
    public $name;
    public $email;
    public $text;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 52],
            [['text'], 'string', 'max' => 255],
            [['name', 'email', 'text'] , 'required']
        ];
    }

    public function save()
    {
        $claim = new Claim();

        $claim->name = $this->name;
        $claim->email = $this->email;
        $claim->text = $this->text;
        $claim->timestamp = time();

        return $claim->save();
    }
}
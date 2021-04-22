<?php


namespace frontend\modules\user\models\forms;

use frontend\modules\user\components\helpers\AvatarHelper;
use yii\base\Model;

class UpdateAvatarForm extends Model
{
    public $file;
    public $user_id;

    public function attributeLabels()
    {
        return [
            'file' => 'Файл',
            'user_id' => 'ид поста',
        ];
    }

    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'png, jpg'],
            [['user_id'], 'integer']
        ];
    }

    public function updateAvatar()
    {
        return AvatarHelper::saveAvatar($this, $this->user_id, 'file');
    }
    
}
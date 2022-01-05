<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "adress".
 *
 * @property int $id
 * @property int|null $post_id
 * @property float|null $x
 * @property float|null $y
 * @property string|null $adress
 */
class Adress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adress';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id'], 'integer'],
            [['x', 'y'], 'number'],
            [['adress'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'x' => 'X',
            'y' => 'Y',
            'adress' => 'Adress',
        ];
    }
}

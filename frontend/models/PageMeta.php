<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "page_meta".
 *
 * @property int $id
 * @property int|null $city_id
 * @property string|null $page_name
 * @property string|null $title
 * @property string|null $des
 * @property string|null $h1
 * @property string|null $h2
 * @property string|null $text
 */
class PageMeta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page_meta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id'], 'integer'],
            [['page_name'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 150],
            [['des', 'text'], 'string', 'max' => 255],
            [['h1', 'h2'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'page_name' => 'Page Name',
            'title' => 'Title',
            'des' => 'Des',
            'h1' => 'H1',
            'h2' => 'H2',
            'text' => 'Text',
        ];
    }
}

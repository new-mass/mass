<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "filter_params".
 *
 * @property int $id
 * @property string|null $url урл который нужно связать с классом параметров
 * @property string|null $class_name имя класса к которому относиться свойство с нейспекйсом
 * @property string|null $relation_class имя класса в котором храниться связь между параметром и пользователем
 * @property string|null $column_param_name Имя искомой колонки
 */
class FilterParams extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'filter_params';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'class_name', 'relation_class', 'column_param_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'урл который нужно связать с классом параметров',
            'class_name' => 'имя класса к которому относиться свойство с нейспекйсом',
            'relation_class' => 'имя класса в котором храниться связь между параметром и пользователем',
            'column_param_name' => 'Имя искомой колонки',
        ];
    }
}

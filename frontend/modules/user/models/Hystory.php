<?php

namespace frontend\modules\user\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "hystory".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $type
 * @property int|null $timestamp
 * @property int|null $balance Остаток на счете
 * @property int|null $sum Сумма списания
 */
class Hystory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hystory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'timestamp', 'balance', 'sum'], 'integer'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'type' => 'Тип',
            'timestamp' => 'Дата/Время',
            'balance' => 'Остаток на счете',
            'sum' => 'Сумма списания',
        ];
    }

    public function search($params, $user_id)
    {
        $query = Hystory::find()->andWhere(['user_id' => $user_id])->orderBy('id DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'timestamp' => $this->timestamp,
            'balance' => $this->balance,
            'sum' => $this->sum,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }

}

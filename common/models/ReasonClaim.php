<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reason_claim".
 *
 * @property int $id
 * @property string|null $value
 *
 * @property AnketClaim[] $anketClaims
 */
class ReasonClaim extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reason_claim';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[AnketClaims]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnketClaims()
    {
        return $this->hasMany(AnketClaim::className(), ['reason_id' => 'id']);
    }
}

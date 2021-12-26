<?php

use frontend\modules\user\models\Metro;
use yii\db\Migration;

/**
 * Class m211225_135706_add_spb_geo_to_metro
 */
class m211225_135706_add_spb_geo_to_metro extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $metroList = Metro::find()->all();

        $metroCoord = include Yii::getAlias('@app/files/spb_metro_gps.php');

        foreach ($metroList as $metroItem){

            foreach ($metroCoord as $key => $item){

                if ($metroItem['value'] == $key){

                    $tempData = \explode(',', $item);

                    if ($tempData[0] > 0){

                        $metroItem->x = $tempData[0];
                        $metroItem->y = \trim($tempData[1]);

                        $metroItem->save();

                    }

                }

            }

        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211225_135706_add_spb_geo_to_metro cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211225_135706_add_spb_geo_to_metro cannot be reverted.\n";

        return false;
    }
    */
}

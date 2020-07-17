<?php


namespace frontend\modules\user\components\helpers;


class SaveRelationHelper
{
    public static function save($class, $property, $userId)
    {
        if (is_array($property)){

            $class::deleteAll(['user_id' => $userId]);

            foreach ($property as $item){

                $object = new $class;

                $object->prop_id  = $item;
                $object->user_id  = $userId;

                $object->save();


            }
        }
    }
}
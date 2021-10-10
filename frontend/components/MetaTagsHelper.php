<?php


namespace frontend\components;


class MetaTagsHelper
{
    public static function singleTitle($post, $city){

        $pol = '';

        if ($post['pol'] == 2) $pol = 'Массажистка ';
        else $pol = 'Массажистка';

        return $pol . ' ' . $post['name'] . ' возраст ' . $post['age'] . ' цена за сеанс ' .
            $post['price'] . ' рублей, город ' . $city['value'] . ' номер телефона '.$post['phone'] .' ID '.$post['id'];

    }
    public static function singleDes($post, $city){

        if ($post['pol'] == 2) $pol = 'Массажистка ';
        else $pol = 'Массажистка';

        return $pol . ' ' . $post['name'] . ' работаю в городе ' . $city['value'] . ' , 
        стоимость сеанса составляет ' . $post['price'] . ' рублей, жду Ваших звонков ID '.$post['id'] ;

    }


}
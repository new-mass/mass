<?php


namespace frontend\components;


class MetaTagsHelper
{
    public static function singleTitle($post, $city){

        $pol = '';

        if ($post['pol'] == 2) $pol = 'Массажистка ';
        else $pol = 'Массажистка';

        return $pol . ' ' . $post['name'] . ' возраст ' . $post['age'] . ' цена за сеанс ' . $post['price'] . ' рублей, город ' . $city['value'];

    }
    public static function singleDes($post, $city){

        $pol = '';

        if ($post['pol'] == 2) $pol = 'Массажистка ';
        else $pol = 'Массажистка';

        if (iconv_strlen($post['about']) < 100) {

            return $pol . ' ' . $post['name'] . ' работаю в городе ' . $city['value'] . ' , стоимость сеанса составляет ' . $post['price'] . ' рублей, жду Ваших звонков';

        } else {

            $params = explode('.',$post['about']);

            $count = 0;

            $string = array();

            foreach ($params as $value){

                $count = $count + iconv_strlen($value);

                if ($value != NULL){

                    $string[] = $value;

                }

                if ($count > 200){

                    return implode('.', $string);

                }

            }
            return implode('.', $string);

        }
    }


}
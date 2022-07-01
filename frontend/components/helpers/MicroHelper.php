<?php

namespace frontend\components\helpers;

class MicroHelper
{
    public function image($post)
    {

        if (!isset($post['avatar']['file']) or !$post['avatar']['file']) return '';

        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'ImageObject',
            'author' => 'Массажистка '. $post['name'],
            'contentUrl' => 'https://'.$_SERVER['HTTP_HOST'].$post['avatar']['file'],
            'contentLocation' => $post['city']['city'].' Россия',
            'datePublished' => date('Y-d-m', $post['created_at']),
            'name' => 'Проститутка '. $post['name'],
        ];

        $data = '<script type="application/ld+json">'.json_encode($data).'</script>';

        return $data;

    }

    public function logo($city)
    {

        $url = 'https://e-mass.top';
        $logo = 'https://e-mass.top/imgs/logo.png';

        if ($city != 'moskva') {

            $url = 'https://'.$city.'.e-mass.top';
            $logo = 'https://'.$city.'.e-mass.top/imgs/logo.png';

        }

        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'url' => $url,
            'logo' => $logo,
        ];

        $data = '<script type="application/ld+json">'.json_encode($data).'</script>';

        return $data;

    }

}
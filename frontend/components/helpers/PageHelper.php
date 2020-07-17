<?php


namespace frontend\components\helpers;


class PageHelper
{
    public static function PageOffsetHelper($page)
    {
        if (strstr($page, 'page=')) return preg_replace("/[^0-9]/", '', strstr($page, 'page='));

        return 1;
    }

    public static function getPageNumber($limit, $offset)
    {
        return $offset / $limit;
    }

    public static function getUrl($url, $page)
    {
        if ($url != '/') $url.='/';

        if (strstr($url, 'page')) $url = strstr($url, '/?page', true);

        if ($page > 1) $page_url = $url.'?page='.$page;
        else $page_url = $url.'?page='.$page;

        return $page_url;
    }

    public static function cropUriParams($uri)
    {
        if (strpos($uri, '/?')) return strstr($uri, '/?', true);
        if (strpos($uri, '?')) return strstr($uri, '?', true);
        return $uri;
    }
}
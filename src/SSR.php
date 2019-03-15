<?php

namespace Yangyao\SSR;


use GuzzleHttp\Client;

class SSR
{
    /**
     * ger ssr link from subscribe link
     * @param $link
     * @return bool|string
     */
    public static function getFromSubLink($link)
    {
        $client = new Client();
        $plain = base64_decode($client->get($link)->getBody());
        return $plain;
    }

}

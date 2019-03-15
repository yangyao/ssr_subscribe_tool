<?php

namespace Yangyao\SSR;


use GuzzleHttp\Client;

class Netlify
{

    private $accessToken;
    private $domain;
    private $client;
    private $endpoint = 'https://api.netlify.com/api/v1/';

    /**
     * Netlify constructor.
     * @param $accessToken
     * @param $domain
     */
    public function __construct($accessToken,$domain)
    {
        $this->client = new Client();
        $this->accessToken = $accessToken;
        $this->domain = $domain;

    }

    /**
     * get site info by domain
     * @return mixed
     */
    public function getSite()
    {
        $link = $this->endpoint."sites?access_token=".$this->accessToken;
        $response = (string)$this->client->get($link)->getBody();
        $siteInfo = json_decode($response,true);
        return collect($siteInfo)->where('url',$this->domain)->first();
    }

    /**
     * get submissions by site and form_name
     * @param $siteId
     * @param $name
     * @return array
     */
    public function getSubmissions($siteId,$name){
        $link = $this->endpoint."sites/{$siteId}/submissions?access_token=".$this->accessToken;
        $response = (string)$this->client->get($link)->getBody();
        $submissionsInfo = json_decode($response,true);
        return collect($submissionsInfo)->where('form_name',$name)->all();
    }

}

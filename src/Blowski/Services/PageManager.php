<?php

namespace Blowski\Services;

use GuzzleHttp\Client;

class PageManager
{

    private $cache = [];
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getPage($url)
    {
        if($this->isPageInCache($url)) {
            return $this->loadPageFromCache($url);
        }
        $html = $this->loadPageFromUrl($url);
        $this->addPageToCache($url, $html);
        return $html;
    }

    public function getSizeOfPage($url)
    {
        $html = $this->getPage($url);
        $size = number_format(strlen($html) / 1000, 1);
        return sprintf('%sKB', $size);
    }

    public function getClient()
    {
        return $this->client;
    }

    protected function addPageToCache($url, $html)
    {
        $this->cache[md5($url)] = $html;
    }

    protected function loadPageFromUrl($url)
    {
        return $this->client->get($url)->getBody()->getContents();
    }

    protected function loadPageFromCache($url)
    {
        return $this->cache[md5($url)];
    }

    protected function isPageInCache($url)
    {
        return array_key_exists(md5($url), $this->cache);
    }


}
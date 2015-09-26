<?php

namespace Blowski\Services;

class URLConsumer
{

    protected $client;

    public function __construct(\Buzz\Browser $client)
    {
        $this->client = $client;
    }

    public function consume($url)
    {
        return $this->client->get($url);
    }


}
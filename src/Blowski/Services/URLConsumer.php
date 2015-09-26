<?php

namespace Blowski\Services;

class URLConsumer
{

    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function consume($url)
    {

    }

}
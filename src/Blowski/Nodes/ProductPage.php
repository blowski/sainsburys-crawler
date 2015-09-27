<?php

namespace Blowski\Nodes;

use Blowski\Configuration\CssPaths;
use Symfony\Component\DomCrawler\Crawler;

class ProductPage
{

    protected $crawler;

    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    public function getDescription()
    {
        return trim($this->crawler->filter(CssPaths::PRODUCT_PAGE_PRODUCT_DESCRIPTION)->text());
    }

}
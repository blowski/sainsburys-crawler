<?php

namespace Blowski\Nodes;

use Blowski\Configuration\CssPaths;
use Blowski\Services\CssPathManager;
use Symfony\Component\DomCrawler\Crawler;

class CategoryPage
{

    protected $crawler;

    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    public function getProducts()
    {
        return $this->crawler->filter(CssPaths::CATEGORY_PAGE_PRODUCT_LIST);
    }

}
<?php

namespace Blowski\Nodes;

use Blowski\Configuration\CssPaths;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class ProductPage
 *
 * Contains the HTML from a product page and lets you extract content from it
 */
class ProductPage
{

    protected $crawler;

    /**
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return trim($this->crawler->filter(CssPaths::PRODUCT_PAGE_PRODUCT_DESCRIPTION)->text());
    }

}
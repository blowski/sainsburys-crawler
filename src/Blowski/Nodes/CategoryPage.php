<?php

namespace Blowski\Nodes;

use Blowski\Configuration\CssPaths;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class CategoryPage
 *
 * Contains all the HTML from a category URL
 */
class CategoryPage
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
     * @return Crawler - all the product items on the category page
     */
    public function getProducts()
    {
        return $this->crawler->filter(CssPaths::CATEGORY_PAGE_PRODUCT_LIST);
    }

}
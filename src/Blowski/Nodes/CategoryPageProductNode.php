<?php

namespace Blowski\Nodes;

use Blowski\Configuration\CssPaths;
use Blowski\Util\PriceFormatter;
use Symfony\Component\DomCrawler\Crawler;

class CategoryPageProductNode
{

    protected $product_node;

    public function __construct(Crawler $product_node)
    {
        $this->product_node = $product_node;
    }

    public function getTitle()
    {
        return trim($this->product_node->filter(CssPaths::CATEGORY_PAGE_PRODUCT_NODE_TITLE)->text());
    }

    public function getProductHref()
    {
        return trim($this->product_node->filter(CssPaths::CATEGORY_PAGE_PRODUCT_NODE_PRODUCT_PAGE_URL)->attr('href'));
    }

    /** @return int - unit price in pence */
    public function getUnitPrice()
    {
        $price_as_extracted = $this->product_node->filter(CssPaths::CATEGORY_PAGE_PRODUCT_NODE_UNIT_PRICE)->text();
        $price_as_float = PriceFormatter::removeUnitText(PriceFormatter::removePoundSign($price_as_extracted));
        return intval( $price_as_float * 100 );
    }

}
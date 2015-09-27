<?php

namespace Blowski\Tests\Nodes;

use Blowski\Nodes\CategoryPageProductNode as SUT;
use Symfony\Component\DomCrawler\Crawler;

class CategoryPageProductNodeTest extends \PHPUnit_Framework_TestCase
{

    public $SUT;

    public function setUp()
    {
        $html = file_get_contents(__DIR__.'/../Fixtures/category-page-product-node.html');
        $crawler = new Crawler();
        $crawler->addHtmlContent($html, 'ISO-8859-1');
        $this->SUT = new SUT($crawler);
    }

    public function test_it_extracts_the_title()
    {
        $this->assertEquals("Sainsbury's Apricot Ripe & Ready x5", $this->SUT->getTitle());
    }

    public function test_it_extracts_the_price()
    {
        $this->assertEquals(300, $this->SUT->getUnitPrice());
    }

    public function test_it_extracts_the_link_to_the_product_page()
    {
        $this->assertEquals('http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-apricot-ripe---ready-320g', $this->SUT->getProductHref());
    }

}

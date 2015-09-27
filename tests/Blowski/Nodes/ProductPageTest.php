<?php

namespace Blowski\Tests\Nodes;

use Blowski\Nodes\ProductPage as SUT;
use Symfony\Component\DomCrawler\Crawler;

class ProductPageTest extends \PHPUnit_Framework_TestCase
{

    public function test_it_extracts_description()
    {
        $html = file_get_contents(__DIR__.'/../Fixtures/product-page.html');
        $crawler = new Crawler();
        $crawler->addHtmlContent($html, 'ISO-8859-1');
        $SUT = new SUT($crawler);
        $this->assertEquals("Apricots", $SUT->getDescription());
    }

}
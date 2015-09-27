<?php

namespace Blowski\Tests\Nodes;

use Blowski\Configuration\CssPaths;
use Blowski\Nodes\CategoryPage as SUT;

class CategoryPageTest extends \PHPUnit_Framework_TestCase
{

    public function test_it_returns_an_instance_of_crawler_when_getting_products()
    {
        $crawler_mock = \Mockery::mock('\Symfony\Component\DomCrawler\Crawler');
        $crawler_mock->shouldReceive('filter')->with(CssPaths::CATEGORY_PAGE_PRODUCT_LIST)->andReturn('bar');
        $SUT = new SUT($crawler_mock);

        $this->assertEquals('bar', $SUT->getProducts());
    }

    public function tearDown()
    {
        \Mockery::close();
    }

}

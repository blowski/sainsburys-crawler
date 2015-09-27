<?php

namespace Blowski\Tests\Entity;

use Blowski\Entity\ProductCollection as SUT;

class ProductCollectionTest extends \PHPUnit_Framework_TestCase
{

    public $SUT;

    public function setUp()
    {
        $this->SUT = new SUT;
    }

    public function test_it_adds_a_product_to_collection()
    {
        $product_mock = \Mockery::mock('\Blowski\Entity\Product');
        $this->SUT->addProduct($product_mock);

        $this->assertCount(1, $this->SUT->getProducts());
    }

}

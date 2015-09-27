<?php

namespace Blowski\Tests\Services;

use Blowski\Services\CategoryPageToJsonTransformer as SUT;

class CategoryPageToJsonTransformerTest extends \PHPUnit_Framework_TestCase
{

    public $SUT;

    public function setUp()
    {
        $page_manager_mock = \Mockery::mock('\Blowski\Services\PageManager');
        $this->SUT = new SUT($page_manager_mock);
    }

    public function test_it_transforms_a_url_to_json()
    {
        $this->SUT->getPageManager()
            ->shouldReceive('getPage')
            ->with('http://www.sainsburys.co.uk')
            ->andReturn(file_get_contents(__DIR__.'/../Fixtures/category-page.html'))
        ;

        $product_page_urls = [
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-apricot-ripe---ready-320g',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-avocado-xl-pinkerton-loose-300g',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-avocado--ripe---ready-x2',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-avocados--ripe---ready-x4',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-conference-pears--ripe---ready-x4-%28minimum%29',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-golden-kiwi--taste-the-difference-x4-685641-p-44',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-kiwi-fruit--ripe---ready-x4',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-kiwi-fruit--so-organic-x4',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-mango--ripe---ready-x2',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-nectarines--ripe---ready-x4',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-papaya--ripe-%28each%29',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-peaches-ripe---ready-x4',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-plums--firm---sweet-x4-%28minimum%29',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-pears--ripe---ready-x4-%28minimum%29',
            'http://www.sainsburys.co.uk/shop/gb/groceries/ripe---ready/sainsburys-white-flesh-nectarines--ripe---ready-x4',
        ];

        foreach($product_page_urls as $url) {
            $this->SUT->getPageManager()
                ->shouldReceive('getPage')
                ->with($url)
                ->andReturn(file_get_contents(__DIR__.'/../Fixtures/product-page.html'))
            ;

            $this->SUT->getPageManager()
                ->shouldReceive('getSizeOfPage')
                ->with($url)
                ->andReturn('10KB')
            ;
        }


        $response = $this->SUT->transform('http://www.sainsburys.co.uk');

        $this->assertTrue($this->isValidJson($response));
        $response_array = json_decode($response, true);
        $this->assertCount(2, $response_array);
        $this->assertArrayHasKey('results', $response_array);
        $this->assertCount(15, $response_array['results']);
        $this->assertArrayHasKey('total', $response_array);
        $this->assertEquals(30.05, $response_array['total']);

        $this->assertArrayHasKey('title', $response_array['results'][0]);
        $this->assertEquals("Sainsbury's Apricot Ripe & Ready x5", $response_array['results'][0]['title']);

        $this->assertArrayHasKey('size', $response_array['results'][0]);
        $this->assertEquals('10KB', $response_array['results'][0]['size']);

        $this->assertArrayHasKey('unit_price', $response_array['results'][0]);
        $this->assertEquals(3.00, $response_array['results'][0]['unit_price']);

        $this->assertArrayHasKey('description', $response_array['results'][0]);
        $this->assertEquals('Apricots', $response_array['results'][0]['description']);

        /** verifying with second result */
        $this->assertArrayHasKey('title', $response_array['results'][1]);
        $this->assertEquals("Sainsbury's Avocado Ripe & Ready XL Loose 300g", $response_array['results'][1]['title']);

        $this->assertArrayHasKey('size', $response_array['results'][1]);
        $this->assertEquals('10KB', $response_array['results'][1]['size']);

        $this->assertArrayHasKey('unit_price', $response_array['results'][1]);
        $this->assertEquals(1.50, $response_array['results'][1]['unit_price']);

        $this->assertArrayHasKey('description', $response_array['results'][1]);
        $this->assertEquals('Apricots', $response_array['results'][1]['description']);
    }

    private function isValidJson($string)
    {
        if(!is_string($string)) {
            return false;
        }
        $result = json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function tearDown()
    {
        \Mockery::close();
    }

}

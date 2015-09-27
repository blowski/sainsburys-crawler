<?php

namespace Blowski\Tests\Services;

use Blowski\Services\PageManager as SUT;

class PageManagerTest extends \PHPUnit_Framework_TestCase
{

    public $SUT;

    public function setUp()
    {
        $client_mock = \Mockery::mock('\GuzzleHttp\Client');
        $this->SUT = new SUT($client_mock);
    }

    public function test_it_loads_a_url()
    {
        $client_mock = $this->SUT->getClient();
        $client_mock->shouldReceive('get->getBody->getContents')->andReturn('<h1>HTML goes here</h1>');

        $this->assertEquals('<h1>HTML goes here</h1>', $this->SUT->getPage('http://example.com'));
    }

    public function test_it_loads_a_page_from_cache_if_it_has_already_been_loaded_once()
    {
        $client_mock = $this->SUT->getClient();
        $client_mock->shouldReceive('get->getBody->getContents')->once()->andReturn('<h1>HTML goes here</h1>');

        /** running it three times to establish that it always returns the correct HTML, but only makes one HTTP request */
        for($ii=0;$ii<3;$ii++) {
            $this->assertEquals('<h1>HTML goes here</h1>', $this->SUT->getPage('http://example.com'));
        }
    }

    public function test_it_calculates_the_size_of_a_page()
    {
        $client_mock = $this->SUT->getClient();
        $client_mock->shouldReceive('get->getBody->getContents')->once()->andReturn(file_get_contents(__DIR__.'/../Fixtures/category-page.html'));

        $this->assertEquals('173.1KB', $this->SUT->getSizeOfPage('http://example.com'));
    }

    public function tearDown()
    {
        \Mockery::close();
    }

}

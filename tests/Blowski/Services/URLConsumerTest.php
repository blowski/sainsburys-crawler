<?php

namespace Blowski\Tests\Services;

use Blowski\Services\URLConsumer as SUT;

class URLConsumerTest extends \PHPUnit_Framework_TestCase
{

    public function test_it_consumes_a_url()
    {
        $client_mock = \Mockery::mock('Buzz\\Browser');
        $client_mock
            ->shouldReceive('get')
            ->with('http://www.sainsburys.co.uk/some/path')
            ->andReturn('<h1>Some HTML</h1>')
        ;
        $SUT = new SUT($client_mock);
        $this->assertEquals( '<h1>Some HTML</h1>', $SUT->consume('http://www.sainsburys.co.uk/some/path') );
    }

    public function tearDown()
    {
        \Mockery::close();
    }

}
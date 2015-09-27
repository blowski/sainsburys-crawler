<?php

namespace Blowski\Tests\Util;

use Blowski\Util\PriceFormatter as SUT;

class FormatPriceTest extends \PHPUnit_Framework_TestCase
{

    public function test_it_removes_pound_sign()
    {
        $this->assertEquals(5, SUT::removePoundSign('£5'));
    }

    public function test_it_removes_unit_text()
    {
        $this->assertEquals(10, SUT::removeUnitText('10/unit'));
    }

}

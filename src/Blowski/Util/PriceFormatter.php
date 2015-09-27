<?php

namespace Blowski\Util;

class PriceFormatter
{

    public static function removePoundSign($price)
    {
        return str_replace('£', '', $price);
    }

    public static function removeUnitText($price)
    {
        return str_replace('/unit', '', $price);
    }

}
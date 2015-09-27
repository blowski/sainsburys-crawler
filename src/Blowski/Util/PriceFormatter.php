<?php

namespace Blowski\Util;

/**
 * Class PriceFormatter
 *
 * Some static helper methods for removing extraneous info from prices
 * so they can be turned into floats or integers
 */
class PriceFormatter
{

    /**
     * This only works if the supplied price is in UTF-8
     *
     * @param $price
     * @return string - the price with any £ signs removed
     */
    public static function removePoundSign($price)
    {
        return str_replace('£', '', $price);
    }

    /**
     * @param $price
     * @return string - the price with any '/unit' strings removed
     */
    public static function removeUnitText($price)
    {
        return str_replace('/unit', '', $price);
    }

}
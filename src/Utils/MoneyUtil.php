<?php

namespace URPay\Utils;

class MoneyUtil
{

    private function __construct()
    { }

    public static function convertIntToDecimal($val)
    {
        if ($val > 0) {
            $val = \substr_replace($val, '.', -2, 0);
        }

        return $val;
    }

    public static function convertDecimalToInt($val)
    {
        if ($val > 0) {
            $number_format =  \number_format($val, 2);
            $number_format = str_replace(".", "", $number_format);
            $val = str_replace(",", "", $number_format);
        }

        return $val;
    }
}

<?php

namespace Tests;

use URPay\Utils\MoneyUtil;

class MoneyUtilTest extends TestCase
{
    public function testConvertIntToDecimal()
    {
        $val = "100";
        $decimal = MoneyUtil::convertIntToDecimal($val);

        $this->assertEquals($decimal, '1.00');
    }

    public function testConvertDecimalToInt()
    {
        $val = "1.00";
        $decimal = MoneyUtil::convertDecimalToInt($val);

        $this->assertEquals($decimal, '100');
    }
}

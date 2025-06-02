<?php

namespace Tests\Units;

use mamdadDev\BinaryTool\Contracts\GMPConvertor;
use mamdadDev\BinaryTool\Enums\Byte;

use PHPUnit\Framework\TestCase;

class BigBinaryConvertorTest extends TestCase
{
    public function testPackUnpackBigInteger()
    {
        $convertor = new GMPConvertor();
        $value = gmp_init('123456789123456789123456789');
        $packed = $convertor->pack($value, Byte::SIXTEEN);
        $unpacked = $convertor->unpack($packed, Byte::SIXTEEN);

        $this->assertEquals(gmp_strval($value), gmp_strval($unpacked), 'Unpacked value does not match the original');
    }
}

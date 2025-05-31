<?php

namespace Tests\Units;

use Nobody\BinaryTool\Contracts\BigBinaryConvertor;
use Nobody\BinaryTool\Enums\Byte;

use PHPUnit\Framework\TestCase;

class BigBinaryConvertorTest extends TestCase
{
    public function testPackUnpackBigInteger()
    {
        $convertor = new BigBinaryConvertor(); 
        $value = gmp_init('123456789123456789123456789');
        $packed = $convertor->pack($value, Byte::CUSTOM);
        $unpacked = $convertor->unpack($packed, Byte::CUSTOM);

        $this->assertEquals(gmp_strval($value), gmp_strval($unpacked), 'Unpacked value does not match the original');
    }
}

<?php

namespace Tests\Units;

use mamdaDev\BinaryTool\Contracts\SmallBinaryConvertor;
use mamdaDev\BinaryTool\Enums\Byte;
use PHPUnit\Framework\TestCase;

class SmallBinaryConvertorTest extends TestCase
{
    public function testPackUnpackSmallInteger()
    {
        $convertor = new SmallBinaryConvertor(1);
        $value = 12345;
        $packed = $convertor->pack($value, Byte::TWO);
        $unpacked = $convertor->unpack($packed, Byte::TWO);

        $this->assertEquals($value, $unpacked);
    }
}

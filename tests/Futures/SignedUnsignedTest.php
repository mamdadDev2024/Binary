<?php

namespace Tests\Futures;

use mamdadDev\BinaryTool\Enums\Byte;
use mamdadDev\BinaryTool\Enums\Endian;
use PHPUnit\Framework\TestCase;
use mamdadDev\BinaryTool\Facades\Binary;

class SignedUnsignedTest extends TestCase
{
    public function testSignedConversion()
    {
        $value = -42;
        $packed = Binary::pack($value, Byte::TWO, Endian::BIG, true);
        $unpacked = Binary::unpack($packed, Byte::TWO, Endian::BIG, true);

        $this->assertEquals($value, $unpacked);
    }

    public function testUnsignedConversion()
    {
        $value = 65000;
        $packed = Binary::pack($value, Byte::TWO, Endian::BIG, false);
        $unpacked = Binary::unpack($packed, Byte::TWO, Endian::BIG, false);

        $this->assertEquals($value, $unpacked);
    }
}

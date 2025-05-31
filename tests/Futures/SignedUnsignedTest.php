<?php

namespace Tests\Futures;

use Nobody\BinaryTool\Enums\Byte;
use Nobody\BinaryTool\Enums\Endian;
use PHPUnit\Framework\TestCase;
use Nobody\BinaryTool\Facades\Binary;

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

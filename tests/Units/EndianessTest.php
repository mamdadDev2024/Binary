<?php

namespace Tests\Units;

use Nobody\BinaryTool\Enums\Byte;
use Nobody\BinaryTool\Enums\Endian;
use Nobody\BinaryTool\Facades\Binary;
use PHPUnit\Framework\TestCase;

class EndianessTest extends TestCase
{
    public function testBigEndian()
    {
        $value = 0x1234;
        $packed = Binary::pack($value, Byte::EIGHT, Endian::BIG, false);
        $this->assertEquals("\x12\x34", $packed);
    }

    public function testLittleEndian()
    {
        $value = 0x1234;
        $packed = Binary::pack($value, Byte::EIGHT, Endian::BIG, false);
        $this->assertEquals("\x34\x12", $packed);
    }

}
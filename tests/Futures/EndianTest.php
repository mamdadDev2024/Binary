<?php

namespace Tests\Futures;

use mamdaDev\BinaryTool\Enums\Byte;
use mamdaDev\BinaryTool\Enums\Endian;
use PHPUnit\Framework\TestCase;
use mamdaDev\BinaryTool\Facades\Binary;

class EndianTest extends TestCase
{
    public function testBigEndian()
    {
        $value = 0x1234;
        $packed = Binary::pack($value, Byte::TWO, Endian::BIG, false);
        $this->assertEquals("\x12\x34", $packed);
    }

    public function testLittleEndian()
    {
        $value = 0x1234;
        $packed = Binary::pack($value, Byte::TWO, Endian::LITTLE, false);
        $this->assertEquals("\x34\x12", $packed);
    }
}

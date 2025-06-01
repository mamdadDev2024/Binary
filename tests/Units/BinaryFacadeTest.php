<?php

namespace Tests\Units;

use mamdaDev\BinaryTool\Enums\Byte;
use mamdaDev\BinaryTool\Enums\Endian;
use mamdaDev\BinaryTool\Facades\Binary;
use PHPUnit\Framework\TestCase;

class BinaryFacadeTest extends TestCase
{
    public function testFacadeUsage()
    {
        $value = 256;
        $packed = Binary::pack($value, Byte::TWO, Endian::BIG);
        $unpacked = Binary::unpack($packed, Byte::TWO, Endian::BIG, false);

        $this->assertEquals($value, $unpacked);
    }
}
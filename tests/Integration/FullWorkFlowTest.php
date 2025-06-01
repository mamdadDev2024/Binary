<?php

namespace Tests\Integration;

use mamdaDev\BinaryTool\Enums\Byte;
use mamdaDev\BinaryTool\Enums\Endian;
use PHPUnit\Framework\TestCase;
use mamdaDev\BinaryTool\Facades\Binary;

class FullWorkflowTest extends TestCase
{
    public function testFullPackUnpackWorkflow()
    {
        $value = gmp_init('987654321987654321987654321');
        $packed = Binary::pack($value, Byte::SIXTEEN, Endian::BIG, false);
        $unpacked = Binary::unpack($packed, Byte::SIXTEEN, Endian::BIG, false);

        $this->assertEquals(gmp_strval($value), gmp_strval($unpacked));
    }
}

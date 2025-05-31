<?php

namespace Tests\Futures;

use Nobody\BinaryTool\Enums\Byte;
use PHPUnit\Framework\TestCase;
use Nobody\BinaryTool\Facades\Binary;

class StrategySelectionTest extends TestCase
{
    public function testStrategySelectionForSmallNumber()
    {
        $value = 42;
        $packed = Binary::pack($value, Byte::TWO);
        $this->assertSame("\x00\x2a", $packed);
    }

    public function testStrategySelectionForBigNumber()
    {
        $value = gmp_init('987654321987654321987654321');
        $packed = Binary::pack($value, Byte::SIXTEEN);
        $this->assertNotEmpty($packed);
    }
}

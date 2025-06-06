<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use mamdadDev\BinaryTool\Facades\Binary;
use TypeError;

class ByteSizeValidationTest extends TestCase
{
    public function testInvalidByteSizeThrowsException()
    {
        $this->expectException(TypeError::class);
        Binary::pack(123, 3); 
    }
}

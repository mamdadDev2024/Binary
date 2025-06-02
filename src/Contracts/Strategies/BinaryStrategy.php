<?php

namespace mamdadDev\BinaryTool\Contracts\Strategies;

use GMP;
use mamdadDev\BinaryTool\Enums\Byte;

interface BinaryStrategy
{
    
    public function pack(int|string|GMP $number , Byte $bytes): string;
    public function unpack(string $binary , Byte $bytes): string;
}
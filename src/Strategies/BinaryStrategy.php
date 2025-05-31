<?php

namespace Nobody\BinaryTool\Strategies;

use GMP;
use Nobody\BinaryTool\Enums\Byte;

interface BinaryStrategy
{
    
    public function pack(int|string|GMP $number , Byte $bytes): string;
    public function unpack(string $binary , Byte $bytes): string;
}
<?php

namespace Nobody\BinaryTool\Strategies;

use Nobody\BinaryTool\Enums\Byte;

interface BinaryStrategy
{
    
    public function pack(int $number , Byte $bytes): string;
    public function unpack(string $binary , Byte $bytes): string;
}
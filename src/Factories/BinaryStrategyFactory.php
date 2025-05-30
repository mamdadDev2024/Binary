<?php

namespace Nobody\BinaryTool\Factories;

use Nobody\BinaryTool\Contracts\BigBinaryConvertor;
use Nobody\BinaryTool\Contracts\SmallBinaryConvertor;
use Nobody\BinaryTool\Enums\Byte;
use Nobody\BinaryTool\Enums\Endian;
use Nobody\BinaryTool\Strategies\BinaryStrategy;

final class BinaryStrategyFactory
{
    public static function make(bool $signed, Byte $bytes = Byte::FOUR, Endian $endian = Endian::BIG): BinaryStrategy
    {
        if ($bytes->value > 8) {
            return new BigBinaryConvertor($signed, $endian);
        } elseif ($bytes->value <= 8 && $bytes->value != 0) {
            return new SmallBinaryConvertor($signed, $endian);
        } else {
            throw new \InvalidArgumentException('Invalid byte');
        }
    }
}



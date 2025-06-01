<?php

namespace mamdaDev\BinaryTool\Factories;

use mamdaDev\BinaryTool\Contracts\BigBinaryConvertor;
use mamdaDev\BinaryTool\Contracts\SmallBinaryConvertor;
use mamdaDev\BinaryTool\Enums\Byte;
use mamdaDev\BinaryTool\Enums\Endian;
use mamdaDev\BinaryTool\Strategies\BinaryStrategy;

/**
 * این کلاس برای ساخت کلاس تبدیل کننده بر اساس اندازه و طول بایت ها است
 */
final class BinaryStrategyFactory
{
    public static function make(bool $signed, Byte $bytes = Byte::FOUR, Endian $endian = Endian::BIG): BinaryStrategy
    {
        if ($bytes->value === 0) {
            throw new \InvalidArgumentException('Byte size cannot be zero.');
        }

        return $bytes->value > 8
            ? new BigBinaryConvertor($signed, $endian)
            : new SmallBinaryConvertor($signed, $endian);
    }
}



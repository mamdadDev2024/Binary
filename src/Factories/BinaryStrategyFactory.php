<?php

namespace mamdaDev\BinaryTool\Factories;

use mamdaDev\BinaryTool\Contracts\GMPConvertor;
use mamdaDev\BinaryTool\Contracts\PackConvertor;
use mamdaDev\BinaryTool\Contracts\Strategies\BinaryStrategy;
use mamdaDev\BinaryTool\Enums\Byte;
use mamdaDev\BinaryTool\Enums\Endian;

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
            ? new GMPConvertor($signed, $endian)
            : new PackConvertor($signed, $endian);
    }
}



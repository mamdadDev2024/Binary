<?php

namespace mamdadDev\BinaryTool\Factories;

use mamdadDev\BinaryTool\Contracts\GMPConvertor;
use mamdadDev\BinaryTool\Contracts\PackConvertor;
use mamdadDev\BinaryTool\Contracts\Strategies\BinaryStrategy;
use mamdadDev\BinaryTool\Enums\Byte;
use mamdadDev\BinaryTool\Enums\Endian;

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



<?php

namespace Nobody\BinaryTool\Facades;

use GMP;
use Nobody\BinaryTool\BinaryTool;
use Nobody\BinaryTool\Enums\Byte;
use Nobody\BinaryTool\Enums\Endian;
use Nobody\BinaryTool\Factories\BinaryStrategyFactory;

final class Binary
{

    public static function pack(int|string|GMP $number, Byte $bytes = Byte::FOUR, Endian $endian = Endian::BIG, ?bool $signed = null): string
    {
        if ($signed === null) {
            $signed = $number < 0;
        }

        $strategy = BinaryStrategyFactory::make($signed, $bytes, $endian);
        $tool = BinaryTool::create($strategy, $bytes);

        return $tool->pack($number);
    }


public static function unpack(string $binary, Byte|int|null $bytes = null, Endian $endian = Endian::BIG, ?bool $signed = null): string
{
    if ($signed === null) {
        $signed = false;
    }

    if ($bytes === null) {
        $length = strlen($binary);

        if (in_array($length, array_column(Byte::cases(), 'value'), true)) {
            $bytes = Byte::from($length);
        } else {
            throw new \InvalidArgumentException("Invalid byte size: $length. Must be one of the defined Byte enum values.");
        }
    }

    if (is_int($bytes)) {
        if (in_array($bytes, array_column(Byte::cases(), 'value'), true)) {
            $bytes = Byte::from($bytes);
        } else {
            throw new \InvalidArgumentException("Invalid byte size: $bytes. Must be one of the defined Byte enum values.");
        }
    }

    $strategy = BinaryStrategyFactory::make($signed, $bytes, $endian);
    $tool = BinaryTool::create($strategy, $bytes);

    return $tool->unpack($binary);
}

}

<?php

namespace Nobody\BinaryTool\Facades;

use Nobody\BinaryTool\BinaryTool;
use Nobody\BinaryTool\Enums\Byte;
use Nobody\BinaryTool\Enums\Endian;
use Nobody\BinaryTool\Factories\BinaryStrategyFactory;

final class Binary
{

    public static function pack(int $number, Byte $bytes = Byte::FOUR, Endian $endian = Endian::BIG, ?bool $signed = null): string
    {
        if ($signed === null) {
            $signed = $number < 0;
        }

        $strategy = BinaryStrategyFactory::make($signed, $bytes, $endian);
        $tool = BinaryTool::create($strategy, $bytes);

        return $tool->pack($number);
    }


    public static function unpack(string $binary, Byte $bytes = Byte::FOUR, Endian $endian = Endian::BIG, ?bool $signed = null): string
    {
        if ($signed === null) {
            $signed = false;
        }

        $strategy = BinaryStrategyFactory::make($signed, $bytes, $endian);
        $tool = new BinaryTool($strategy, $bytes);

        return $tool->unpack($binary);
    }
}

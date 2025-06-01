<?php

namespace mamdaDev\BinaryTool\Factories;

use mamdaDev\BinaryTool\BinaryTool;
use mamdaDev\BinaryTool\Enums\Byte;
use mamdaDev\BinaryTool\Enums\Endian;

class BinaryFactory
{
    /**
     * دریافت ورودی ها و ا
     * @param bool $signed
     * @param \mamdaDev\BinaryTool\Enums\Byte $bytes
     * @param \mamdaDev\BinaryTool\Enums\Endian $endian
     * @return BinaryTool
     */
    public static function create(bool $signed, Byte $bytes = Byte::FOUR, Endian $endian = Endian::BIG): BinaryTool
    {
        $strategy = BinaryStrategyFactory::make($signed, $bytes, $endian);
        return BinaryTool::create($strategy, $bytes);
    }
}
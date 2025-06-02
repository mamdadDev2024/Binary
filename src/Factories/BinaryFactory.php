<?php

namespace mamdadDev\BinaryTool\Factories;

use mamdadDev\BinaryTool\BinaryTool;
use mamdadDev\BinaryTool\Enums\Byte;
use mamdadDev\BinaryTool\Enums\Endian;

class BinaryFactory
{
    /**
     * دریافت ورودی ها و ا
     * @param bool $signed
     * @param \mamdadDev\BinaryTool\Enums\Byte $bytes
     * @param \mamdadDev\BinaryTool\Enums\Endian $endian
     * @return BinaryTool
     */
    public static function create(bool $signed, Byte $bytes = Byte::FOUR, Endian $endian = Endian::BIG): BinaryTool
    {
        $strategy = BinaryStrategyFactory::make($signed, $bytes, $endian);
        return BinaryTool::create($strategy, $bytes);
    }
}
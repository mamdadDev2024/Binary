<?php

namespace Nobody\BinaryTool\Factories;

use Nobody\BinaryTool\BinaryTool;
use Nobody\BinaryTool\Enums\Byte;
use Nobody\BinaryTool\Enums\Endian;

class BinaryFactory
{
    public function create(bool $signed, Byte $bytes = Byte::FOUR, Endian $endian = Endian::BIG): BinaryTool
    {
        $strategy = BinaryStrategyFactory::make($signed, $bytes, $endian);
        return BinaryTool::create($strategy, $bytes);
    }
}
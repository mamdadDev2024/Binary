<?php

namespace Nobody\BinaryTool\Contracts;

use Nobody\BinaryTool\Enums\Byte;
use Nobody\BinaryTool\Enums\Endian;
use Nobody\BinaryTool\Strategies\BinaryStrategy;

class BigBinaryConvertor implements BinaryStrategy
{
    public function __construct(
        protected bool $signed,
        protected Endian $endian,
    ) {}

    public function pack(int $number , Byte $bytes): string
    {
        $gmp = gmp_init($number, 10);
        $binary = gmp_export($gmp);
        return $this->endian === Endian::LITTLE ? strrev($binary) : $binary;
    }

    public function unpack(string $binary , Byte $bytes): string
    {
        if ($this->endian === Endian::LITTLE) {
            $binary = strrev($binary);
        }
        $gmp = gmp_import($binary);
        return gmp_strval($gmp, 10);
    }
}
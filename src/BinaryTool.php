<?php

namespace mamdadDev\BinaryTool;

use GMP;
use mamdadDev\BinaryTool\Contracts\Strategies\BinaryStrategy;
use mamdadDev\BinaryTool\Enums\Byte;

class BinaryTool
{
    private function __construct(
        protected BinaryStrategy $binaryStrategy,
        protected Byte $bytes
    ) {}

    public static function create(BinaryStrategy $strategy, Byte $bytes): self
    {
        return new self($strategy, $bytes);
    }

    public function pack(int|string|GMP $number): string
    {
        return $this->binaryStrategy->pack($number, $this->bytes);
    }

    public function unpack(string $binary): string
    {
        return $this->binaryStrategy->unpack($binary, $this->bytes);
    }
}

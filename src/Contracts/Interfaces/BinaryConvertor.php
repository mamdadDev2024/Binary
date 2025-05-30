<?php

namespace Nobody\BinaryTool\Contracts\Interfaces;

interface BinaryConvertor
{
    public function toBinary(int $number);
    public function fromBinary(string $binary);
}
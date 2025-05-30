<?php

namespace Nobody\BinaryTool\Contracts;

use Nobody\BinaryTool\Enums\Byte;
use Nobody\BinaryTool\Enums\Endian;
use Nobody\BinaryTool\Strategies\BinaryStrategy;

class SmallBinaryConvertor implements BinaryStrategy
{
    public function __construct(protected bool $signed, protected Endian $endian = Endian::BIG) {}

    public function pack(int $number, Byte $bytes): string
    {
        $format = $this->getFormats($this->signed, $this->endian, $bytes);
        return pack($format, $number);
    }

    public function unpack(string $binary, Byte $bytes): string
    {
        $format = $this->getFormats($this->signed, $this->endian, $bytes);
        $result = unpack($format, $binary);

        return (string)array_values($result)[0];
    }

    protected function getFormats(bool $signed, Endian $endian, Byte $bytes): string
    {
        $formats = [
            'big' => [
                2 => $signed ? 's' : 'n',
                4 => $signed ? 'l' : 'N',
                8 => $signed ? 'q' : 'J',
            ],
            'little' => [
                2 => $signed ? 's' : 'v',
                4 => $signed ? 'l' : 'V',
                8 => $signed ? 'q' : 'P',
            ],
        ];

        $byteValue = $bytes->value;

        if (!isset($formats[strtolower($endian->name)][$byteValue])) {
            throw new \InvalidArgumentException("Unsupported byte size for pack/unpack: $byteValue");
        }

        return $formats[strtolower($endian->name)][$byteValue];
    }
}

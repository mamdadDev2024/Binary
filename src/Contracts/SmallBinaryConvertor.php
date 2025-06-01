<?php

namespace mamdaDev\BinaryTool\Contracts;

use GMP;
use mamdaDev\BinaryTool\Enums\Byte;
use mamdaDev\BinaryTool\Enums\Endian;
use mamdaDev\BinaryTool\Strategies\BinaryStrategy;

/**
 * این کلاس برای تبدیل عدد استاندار به باینری و برعکس است با استفاده از متد های pack\unpack که یک استراتژی برای تبدیل می باشد
 */
class SmallBinaryConvertor implements BinaryStrategy
{
    /**
     * این کلاس هم مانند کلاس BigBinaryConvertor دو آرگومان دریافت می کند که البته در هر دوکلاس اختیاری می باشد
     * @param bool $signed
     * @param \mamdaDev\BinaryTool\Enums\Endian $endian
     */
    public function __construct(protected bool $signed, protected Endian $endian = Endian::BIG) {}

    /**
     * این متد برای تبدیل مبنای 10 به 2 با استفاده از pack است
     * @param int|string|\GMP $number
     * @param \mamdaDev\BinaryTool\Enums\Byte $bytes
     * @return string
     */
    public function pack(int|string|GMP $number, Byte $bytes): string
    {
        $format = $this->getFormats($this->signed, $this->endian, $bytes);
        return pack($format, $number);
    }

    /**
     * این متد هم بر عکس متد قبلی
     * @param string $binary
     * @param \mamdaDev\BinaryTool\Enums\Byte $bytes
     * @return string
     */
    public function unpack(string $binary, Byte $bytes): string
    {
        $format = $this->getFormats($this->signed, $this->endian, $bytes);
        $result = unpack($format, $binary);

        return (string)array_values($result)[0];
    }

    /**
     * این متد برای بدست آوردن فرمت مناسب بر اساس پارامتر های مربوط به عدد می باشد
     * @param bool $signed
     * @param \mamdaDev\BinaryTool\Enums\Endian $endian
     * @param \mamdaDev\BinaryTool\Enums\Byte $bytes
     * @throws \InvalidArgumentException
     * @return string
     */
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

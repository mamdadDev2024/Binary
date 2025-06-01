<?php

namespace mamdaDev\BinaryTool\Contracts;

use GMP;
use mamdaDev\BinaryTool\Contracts\Strategies\BinaryStrategy;
use mamdaDev\BinaryTool\Enums\Byte;
use mamdaDev\BinaryTool\Enums\Endian;

/**
 * این کلاس برای تبدیل اعداد غیر استاندارد از نظر طول است و از افزونه GMP(Gnu Multiple Presition) است
 * که یک استراتژی برای تبدیل می باشد
 * اینجا یه مشکلی داشتم که امیدوارم راه حلش خیلی بد نبوده باشه . آرگومان byte در این متد ها بلا استفاده است و نقض اصل Liskov است
 */
class GMPConvertor implements BinaryStrategy
{
    /**
     * این کلاس هنگام ایجاد نمونه دو آرگومان دریافت می کند که یعنی منفی بودن آن است و یکی اندین
     * @param bool $signed
     * @param \mamdaDev\BinaryTool\Enums\Endian $endian
     */
    public function __construct(
        protected bool $signed=false,
        protected Endian $endian=Endian::BIG,
    ) {}

    /**
     * این متد برای دریافت عدد مبنای 10 غیر استاندارد به صورت عدد یا رشته و یا GMP است
     * @param int|string|\GMP $number
     * @param \mamdaDev\BinaryTool\Enums\Byte $bytes
     * @return string
     */
    public function pack(int|string|GMP $number , Byte $bytes): string
    {
        $gmp = gmp_init($number, 10);
        $binary = gmp_export($gmp);
        return $this->endian === Endian::LITTLE ? strrev($binary) : $binary;
    }

    /**
     * این متد برای تبدیل باینری به مبنای 10 است . با استفاده از افزونه GMP
     * @param string $binary
     * @param \mamdaDev\BinaryTool\Enums\Byte $bytes
     * @return string
     */
    public function unpack(string $binary , Byte $bytes): string
    {
        if ($this->endian === Endian::LITTLE) {
            $binary = strrev($binary);
        }
        $gmp = gmp_import($binary);
        return gmp_strval($gmp, 10);
    }
}
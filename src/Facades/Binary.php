<?php

namespace mamdaDev\BinaryTool\Facades;

use GMP;
use mamdaDev\BinaryTool\BinaryTool;
use mamdaDev\BinaryTool\Enums\Byte;
use mamdaDev\BinaryTool\Enums\Endian;
use mamdaDev\BinaryTool\Factories\BinaryFactory;
use mamdaDev\BinaryTool\Factories\BinaryStrategyFactory;

/**
 * این کلاس یه Facade برای تبدیل و مهیا سازی هدف اصلی پروژه به صورت ساده و کم حجم از نظر تعداد کاراکتر ها می باشد
 */
final class Binary
{

    /**
     * برای تبدیل عدد مبنای 10 به 2 و برسی ورودی ها و مقادیر پیش فرض دادن به آنها و انتخاب استراتژی مناسب است
     * @param int|string|\GMP $number
     * @param \mamdaDev\BinaryTool\Enums\Byte $bytes
     * @param \mamdaDev\BinaryTool\Enums\Endian $endian
     * @param mixed $signed
     * @return string
     */
    public static function pack(int|string|GMP $number, Byte $bytes = Byte::FOUR, Endian $endian = Endian::BIG, ?bool $signed = null): string
    {
        if ($signed === null) {
            $signed = gmp_cmp(gmp_init($number, 10), 0) < 0;
        }

        $tool = BinaryFactory::create($signed, $bytes, $endian);

        return $tool->pack($number);
    }


    /**
     * بر عکس متد قبلی
     * @param string $binary
     * @param \mamdaDev\BinaryTool\Enums\Byte|int|null $bytes
     * @param \mamdaDev\BinaryTool\Enums\Endian $endian
     * @param mixed $signed
     * @throws \InvalidArgumentException
     * @return string
     */
    public static function unpack(string $binary, Byte|int|null $bytes = null, Endian $endian = Endian::BIG, ?bool $signed = null): string
    {
        if ($signed === null) {
            $signed = false;
        }

        if ($bytes === null) {
            $length = strlen($binary);

            if (in_array($length, array_column(Byte::cases(), 'value'), true)) {
                $bytes = Byte::from($length);
            } else {
                throw new \InvalidArgumentException("Invalid byte size: $length. Must be one of the defined Byte enum values.");
            }
        }
        if (is_int($bytes)) {
            if (in_array($bytes, array_column(Byte::cases(), 'value'), true)) {
                $bytes = Byte::from($bytes);
            } else {
                throw new \InvalidArgumentException("Invalid byte size: $bytes. Must be one of the defined Byte enum values.");
            }
        }
        $tool = BinaryFactory::create($signed, $bytes, $endian);


        return $tool->unpack($binary);
    }

}

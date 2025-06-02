<?php

namespace mamdadDev\BinaryTool\Contracts\Interfaces;

interface BinaryConvertor
{
    /**
     * این متد برای تبدیل عدد بر مبنای 10 به مبنای 2 یا همان باینری می باشد و عدد رو دریافت می کند . توجه شود که اعداد مبنای 8 یا 16 دریافت نمی کند
     * @param int $number
     * @return string
     */
    public function toBinary(int $number);
    /**
     * این متد برای دریافت عدد باینری و تبدیل آن به عدد مبنای 10 می باشد
     * @param string $binary
     * @return int
     */
    public function fromBinary(string $binary);
}
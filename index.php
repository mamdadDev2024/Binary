<?php

use mamdaDev\BinaryTool\Enums\Byte;
use mamdaDev\BinaryTool\Enums\Endian;
use mamdaDev\BinaryTool\Facades\Binary;

require_once 'vendor/autoload.php';

var_dump(Binary::pack(1234 , Byte::FOUR , Endian::BIG));
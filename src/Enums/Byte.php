<?php

namespace Nobody\BinaryTool\Enums;

enum Byte: int
{
    case TWO=2;
    case FOUR=4;
    case EIGHT=8;
    case CUSTOM=16;
}
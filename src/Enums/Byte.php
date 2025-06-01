<?php

namespace mamdaDev\BinaryTool\Enums;

/**
 * این شمارنده برای اعتبار سنجی و ساده سازی وردی متد های سطح بالا است
 */
enum Byte: int
{
    case TWO = 2;
    case FOUR = 4;
    case EIGHT = 8;
    case SIXTEEN = 16;
    case THIRTY_TWO = 32; 
    case SIXTY_FOUR = 64; 
}

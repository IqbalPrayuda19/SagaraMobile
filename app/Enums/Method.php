<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum Method: string
{
    use Values;
    case STRAIGHT_LINE = 'Straight Line';
    case REDUCING_BALANCE = 'Reducing Balance';
}

?>
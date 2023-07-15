<?php

declare(strict_types=1);

namespace App\Enums;

enum CartStatus: int
{
    case ACTIVE = 1;
    case FINISHED = 0;
}
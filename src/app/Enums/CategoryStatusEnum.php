<?php

declare(strict_types=1);

namespace App\Enums;

enum CategoryStatusEnum: int
{
    case ACTIVE = 1;
    case IN_ACTIVE = 0;
}

<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductInStockEnum: int
{
    case IN_STOCK = 1;
    case NOT_AVAILABLE = 0;
}

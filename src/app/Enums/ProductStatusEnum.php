<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductStatusEnum: string
{
    case ACTIVE = 'active';
    case BLOCKED = 'blocked';
    case DRAFT = 'draft';
}

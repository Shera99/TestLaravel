<?php

namespace App\Enums;

use App\Traits\EnumValues;

enum UserRole: string
{
    use EnumValues;

    case FULL_ACCESS = 'full_access';
    case EDITING = 'editing';
    case READING = 'reading';
}

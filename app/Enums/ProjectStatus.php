<?php

namespace App\Enums;

use App\Traits\EnumValues;

enum ProjectStatus: string
{
    use EnumValues;

    case IN_OPERATION = 'in_operation';
    case CLOSED_SUCCESSFULLY = 'closed_successfully';
    case CLOSED_NOT_SUCCESSFULLY = 'closed_not_successfully';
}

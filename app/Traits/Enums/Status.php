<?php

namespace App\Traits\Enums;

enum Status: string
{
    case CREATED = 'created';
    case OPEN = 'open';
    case CLOSED = 'closed';
    case ARCHIVED = 'archived';
}

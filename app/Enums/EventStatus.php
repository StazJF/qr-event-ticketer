<?php

namespace App\Enums;

enum EventStatus: string
{
    case Active = 'active';
    case Cancelled = 'cancelled';
}

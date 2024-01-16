<?php

namespace App\Enums;

enum OrderStatusType: int
{
    case received = 1;
    case InPreparation = 2;
    case COMPLETED = 3;
}

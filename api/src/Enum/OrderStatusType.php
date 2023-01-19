<?php

namespace App\Enum;


enum OrderStatusType: string
{
    case FAIL = "fail";
    case PENDING = "pending";
    case SUCCESS = "success";
}

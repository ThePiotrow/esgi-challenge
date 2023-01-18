<?php

namespace App\Enum;


enum OrderPaymentType: string
{
    case MASTERCARD = "mastercard";
    case PAYPAL = "paypal";
}

<?php

namespace App\Enum;


enum WalletTransactionStatusType: string
{
    case DEPOSIT = "deposit";
    case WITHDRAWAL = "withdrawal";
}

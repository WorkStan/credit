<?php

namespace App\Credit\Domain\Enum;

enum LoanStatus: string
{
    case New = 'new';
    case Allow = 'allow';
    case Disallow = 'disallow';
    case Issued = 'issued';
    case Repaid = 'repaid';
}

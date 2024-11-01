<?php

namespace App\Shared\Service;

use Symfony\Component\Uid\Uuid;

class UuidGenerator
{
    public function generate(): string
    {
        return Uuid::v4()->toString();
    }
}
<?php

namespace App\Utils;

use Symfony\Component\Uid\Uuid;

// use Symfony\Component\Uid\Uuid;

class UuidGenerator
{
    public function generateUuid(): string
    {
        return Uuid::V4()->toRfc4122();
    }
}

<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Support\Symfony\Uuid\UuidGenerator;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;
use Tuzex\Ddd\Infrastructure\Support\Symfony\Uuid\UuidGenerator;

final class UuidV4Generator implements UuidGenerator
{
    public function generate(): UuidV4
    {
        return Uuid::v4();
    }
}

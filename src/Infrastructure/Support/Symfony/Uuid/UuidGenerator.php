<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Support\Symfony\Uuid;

use Symfony\Component\Uid\Uuid;

interface UuidGenerator
{
    public function generate(): Uuid;
}

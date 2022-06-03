<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Support\Symfony\Uuid;

use Symfony\Component\Uid\Uuid;

interface UuidFactory
{
    public function create(string $name): Uuid;
}

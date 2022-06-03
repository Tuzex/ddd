<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Support\Symfony\Uuid\UuidFactory;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV5;
use Tuzex\Ddd\Infrastructure\Support\Symfony\Uuid\UuidFactory;

final class UuidV5Factory implements UuidFactory
{
    private readonly Uuid $namespace;

    public function __construct()
    {
        $this->namespace = Uuid::fromString(Uuid::NAMESPACE_DNS);
    }

    public function create(string $name): UuidV5
    {
        return Uuid::v5($this->namespace, $name);
    }
}

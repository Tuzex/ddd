<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Support\Symfony\Uuid\UuidFactory;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV3;
use Tuzex\Ddd\Infrastructure\Support\Symfony\Uuid\UuidFactory;

final class UuidV3Factory implements UuidFactory
{
    private readonly Uuid $namespace;

    public function __construct()
    {
        $this->namespace = Uuid::fromString(Uuid::NAMESPACE_DNS);
    }

    public function create(string $name): UuidV3
    {
        return Uuid::v3($this->namespace, $name);
    }
}

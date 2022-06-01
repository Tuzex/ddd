<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Integration;

use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

interface IntegrationEvent
{
    public function __serialize(): array;

    public function __unserialize(array $data): void;

    public function id(): Uuid;

    public function occurredAt(): DateTimeImmutable;
}

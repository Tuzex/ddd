<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Integration;

use DateTimeImmutable as DateTime;
use Symfony\Component\Uid\Uuid;

interface IntegrationEvent
{
    public function id(): Uuid;

    public function occurredAt(): DateTime;

    public function payload(): array;

    public function __serialize(): array;

    public function __unserialize(array $data): void;
}

<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Serialization\Symfony\Uuid;

use Symfony\Component\Uid\Uuid;

trait UuidSerialization
{
    private function serializeUuid(Uuid $uuid): string
    {
        return $uuid->toRfc4122();
    }

    private function unserializeUuid(string $uuid): Uuid
    {
        return new Uuid($uuid);
    }
}
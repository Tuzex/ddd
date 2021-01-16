<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

final class DomainEvents
{
    private static array $domainEvents = [];

    public static function occur(DomainEvent ...$domainEvents): void
    {
        self::$domainEvents = array_merge(self::$domainEvents, $domainEvents);
    }

    /**
     * @return DomainEvent[]
     */
    public static function release(): array
    {
        $domainEvents = self::$domainEvents;
        self::$domainEvents = [];

        return $domainEvents;
    }
}

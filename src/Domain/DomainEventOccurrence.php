<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

trait DomainEventOccurrence
{
    private function raiseDomainEvents(DomainEvent ...$domainEvents): void
    {
        DomainEvents::occur(...$domainEvents);
    }
}

<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

trait DomainEventOccurrence
{
    /**
     * @var array<int|string, DomainEvent>
     */
    private array $domainEvents = [];

    public function domainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    private function occur(DomainEvent ...$domainEvents): void
    {
        $this->domainEvents = array_merge($this->domainEvents, $domainEvents);
    }
}

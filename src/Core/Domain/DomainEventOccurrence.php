<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Core\Domain;

trait DomainEventOccurrence
{
    /**
     * @var array<int|string, DomainEvent>
     */
    private array $domainEvents = [];

    public function domainEvents(): DomainEvents
    {
        $domainEvents = new DomainEvents(...$this->domainEvents);
        $this->domainEvents = [];

        return $domainEvents;
    }

    private function occur(DomainEvent ...$domainEvents): void
    {
        $this->domainEvents = array_merge($this->domainEvents, $domainEvents);
    }
}
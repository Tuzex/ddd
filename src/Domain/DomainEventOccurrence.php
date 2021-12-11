<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

trait DomainEventOccurrence
{
    /**
     * @var array<int|string, DomainEvent>
     */
    private array $domainEvents = [];

    public function domainEvents(): DomainEvents
    {
        $commands = new DomainEvents(...$this->domainEvents);
        $this->domainEvents = [];

        return $commands;
    }

    private function occur(DomainEvent ...$domainEvents): void
    {
        $this->domainEvents = array_merge($this->domainEvents, $domainEvents);
    }
}

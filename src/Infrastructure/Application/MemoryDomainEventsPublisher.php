<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Application;

use Tuzex\Ddd\Application\DomainEventDispatcher;
use Tuzex\Ddd\Application\DomainEventsPublisher;
use Tuzex\Ddd\Domain\DomainEvents;

final class MemoryDomainEventsPublisher implements DomainEventsPublisher
{
    public function __construct(
        private DomainEventDispatcher $domainEventDispatcher
    ) {}

    public function propagate(): void
    {
        $domainEvents = DomainEvents::release();

        foreach ($domainEvents as $domainEvent) {
            $this->domainEventDispatcher->dispatch($domainEvent);
        }
    }
}

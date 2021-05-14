<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Messaging;

use Tuzex\Ddd\Application\DomainEventBus;
use Tuzex\Ddd\Application\Service\DomainEventsEmitter;
use Tuzex\Ddd\Domain\DomainEvents;

final class InMemoryDomainEventsEmitter implements DomainEventsEmitter
{
    public function __construct(
        private DomainEventBus $domainEventBus
    ) {}

    public function emit(): void
    {
        $domainEvents = DomainEvents::release();

        foreach ($domainEvents as $domainEvent) {
            $this->domainEventBus->publish($domainEvent);
        }
    }
}

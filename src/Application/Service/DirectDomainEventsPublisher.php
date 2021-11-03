<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Application\Service;

use Tuzex\Ddd\Application\DomainEventBus;
use Tuzex\Ddd\Domain\DomainEvents;

final class DirectDomainEventsPublisher
{
    public function __construct(
        private DomainEventBus $domainEventBus
    ) {}

    public function publish(DomainEvents $domainEvents): void
    {
        foreach ($domainEvents as $domainEvent) {
            $this->domainEventBus->publish($domainEvent);
        }
    }
}

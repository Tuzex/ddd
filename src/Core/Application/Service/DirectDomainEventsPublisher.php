<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Core\Application\Service;

use Tuzex\Ddd\Core\Application\DomainEventBus;
use Tuzex\Ddd\Core\Domain\DomainEvents;

final class DirectDomainEventsPublisher implements DomainEventsPublisher
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

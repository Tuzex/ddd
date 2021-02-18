<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Application;

use Tuzex\Ddd\Domain\DomainEvents;

final class StaticDomainEventsPropagator implements DomainEventsPropagator
{
    public function __construct(
        private DomainEventBus $domainEventBus
    ) {}

    public function propagate(): void
    {
        $domainEvents = DomainEvents::release();

        foreach ($domainEvents as $domainEvent) {
            $this->domainEventBus->publish($domainEvent);
        }
    }
}

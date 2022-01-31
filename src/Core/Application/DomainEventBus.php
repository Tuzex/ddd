<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Core\Application;

use Tuzex\Ddd\Core\Domain\DomainEvent;

interface DomainEventBus
{
    public function publish(DomainEvent $domainEvent): void;
}

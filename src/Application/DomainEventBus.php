<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Application;

use Tuzex\Ddd\Domain\DomainEvent;

interface DomainEventBus
{
    public function publish(DomainEvent ...$domainEvents): void;
}

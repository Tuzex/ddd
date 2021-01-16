<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Application;

use Tuzex\Ddd\Domain\DomainEvent;

interface DomainEventDispatcher
{
    public function dispatch(DomainEvent $domainEvent): void;
}

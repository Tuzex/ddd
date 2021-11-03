<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Application\Service;

use Tuzex\Ddd\Domain\DomainEvents;

interface DomainEventsPublisher
{
    public function publish(DomainEvents $domainEvents): void;
}

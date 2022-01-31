<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Core\Application\Service;

use Tuzex\Ddd\Core\Domain\DomainEvents;

interface DomainEventsPublisher
{
    public function publish(DomainEvents $domainEvents): void;
}

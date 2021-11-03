<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

use Tuzex\Ddd\Domain\Shared\Identifier;

interface AggregateRoot
{
    public function id(): Identifier;

    public function domainEvents(): DomainEvents;
}

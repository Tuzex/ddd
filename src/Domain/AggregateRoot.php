<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

interface AggregateRoot
{
    public function id(): Identifier;

    public function domainEvents(): array;
}

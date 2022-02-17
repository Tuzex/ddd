<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

interface DomainEvent
{
    public function occurredOn(): DateTime;
}

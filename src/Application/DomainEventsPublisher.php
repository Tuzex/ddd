<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Application;

interface DomainEventsPublisher
{
    public function propagate(): void;
}

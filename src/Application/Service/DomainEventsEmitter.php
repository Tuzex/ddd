<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Application\Service;

interface DomainEventsEmitter
{
    public function emit(): void;
}

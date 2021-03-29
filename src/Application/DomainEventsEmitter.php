<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Application;

interface DomainEventsEmitter
{
    public function emit(): void;
}

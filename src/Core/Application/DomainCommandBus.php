<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Core\Application;

use Tuzex\Ddd\Core\Domain\DomainCommand;

interface DomainCommandBus
{
    public function dispatch(DomainCommand $domainCommand): void;
}

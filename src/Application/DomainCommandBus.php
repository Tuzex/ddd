<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Application;

use Tuzex\Ddd\Domain\DomainCommand;

interface DomainCommandBus
{
    public function dispatch(DomainCommand ...$domainCommands): void;
}

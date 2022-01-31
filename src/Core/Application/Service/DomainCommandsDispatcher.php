<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Core\Application\Service;

use Tuzex\Ddd\Core\Domain\DomainCommands;

interface DomainCommandsDispatcher
{
    public function dispatch(DomainCommands $domainCommands): void;
}

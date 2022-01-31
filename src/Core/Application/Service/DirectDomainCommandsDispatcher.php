<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Core\Application\Service;

use Tuzex\Ddd\Core\Application\DomainCommandBus;
use Tuzex\Ddd\Core\Domain\DomainCommands;

final class DirectDomainCommandsDispatcher implements DomainCommandsDispatcher
{
    public function __construct(
        private DomainCommandBus $domainCommandBus
    ) {}

    public function dispatch(DomainCommands $domainCommands): void
    {
        foreach ($domainCommands as $domainCommand) {
            $this->domainCommandBus->dispatch($domainCommand);
        }
    }
}

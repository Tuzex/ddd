<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Messaging;

use Tuzex\Ddd\Application\CommandBus;
use Tuzex\Ddd\Application\Service\CommandsSpooler;
use Tuzex\Ddd\Domain\Commands;

final class InMemoryCommandsSpooler implements CommandsSpooler
{
    public function __construct(
        private CommandBus $domainCommandBus
    ) {}

    public function send(): void
    {
        $domainCommands = Commands::release();

        foreach ($domainCommands as $domainCommand) {
            $this->domainCommandBus->execute($domainCommand);
        }
    }
}

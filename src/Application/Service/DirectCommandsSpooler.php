<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Application\Service;

use Tuzex\Ddd\Application\CommandBus;
use Tuzex\Ddd\Domain\Commands;

final class DirectCommandsSpooler
{
    public function __construct(
        private CommandBus $commandBus
    ) {}

    public function send(Commands $commands): void
    {
        foreach ($commands as $command) {
            $this->commandBus->execute($command);
        }
    }
}

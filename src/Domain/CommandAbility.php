<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

trait CommandAbility
{
    private function issueCommand(Command $command): void
    {
        Commands::issue($command);
    }
}

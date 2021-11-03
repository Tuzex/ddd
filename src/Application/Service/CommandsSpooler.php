<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Application\Service;

use Tuzex\Ddd\Domain\Commands;

interface CommandsSpooler
{
    public function send(Commands $commands): void;
}

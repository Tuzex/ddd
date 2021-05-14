<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Application;

use Tuzex\Ddd\Domain\Command;

interface CommandBus
{
    public function execute(Command $command): void;
}

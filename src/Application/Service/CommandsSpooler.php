<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Application\Service;

interface CommandsSpooler
{
    public function send(): void;
}

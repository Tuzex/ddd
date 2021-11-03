<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

use Tuzex\Ddd\Domain\Timing\DateTime;

interface Command
{
    public function issuedOn(): DateTime;
}

<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Core\Domain;

use Tuzex\Ddd\Timing\Domain\DateTime;

interface DomainCommand
{
    public function issuedOn(): DateTime;
}

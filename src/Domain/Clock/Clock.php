<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Clock;

use Tuzex\Ddd\Domain\Time\Instant;

interface Clock
{
    public function measure(): Instant;
}

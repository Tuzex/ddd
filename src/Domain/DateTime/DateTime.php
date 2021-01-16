<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime;

use Tuzex\Ddd\Domain\Clock\Clock;

interface DateTime
{
    public function isPresent(Clock $clock): bool;

    public function isFuture(Clock $clock): bool;

    public function isPast(Clock $clock): bool;
}

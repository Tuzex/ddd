<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Clock;

use Tuzex\Ddd\Domain\Clock;
use Tuzex\Ddd\Domain\Instant;

final class PresetClock implements Clock
{
    public function __construct(
        private readonly Instant $instant
    ) {}

    public function instant(): Instant
    {
        return $this->instant;
    }
}

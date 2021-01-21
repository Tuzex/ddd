<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Clock;

use Tuzex\Ddd\Domain\DateTime\Instant;

final class SystemClock implements Clock
{
    public function measure(): Instant
    {
        return Instant::of(time());
    }
}

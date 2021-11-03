<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Domain\Timing\Clock;

use Tuzex\Ddd\Domain\Timing\Clock;
use Tuzex\Ddd\Domain\Timing\Instant;
use Tuzex\Timekeeper\TimeService;

final class SystemClock implements Clock
{
    public function __construct(
        private TimeService $timeService
    ) {}

    public function instant(): Instant
    {
        return Instant::of($this->timeService->measure()->getTimestamp());
    }
}

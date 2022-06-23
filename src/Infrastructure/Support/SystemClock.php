<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Support;

use Tuzex\Ddd\Domain\Clock;
use Tuzex\Ddd\Domain\Instant;
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

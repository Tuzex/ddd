<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\UniversalTime\TimePeriod;

use Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit\Hour;

final class Hours extends Period
{
    public static function fromSeconds(Seconds $seconds): self
    {
        return new self(intdiv($seconds->value, Hour::SECONDS_PER_HOUR));
    }
}

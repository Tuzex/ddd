<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Timing\Domain\Period;

use Tuzex\Ddd\Timing\Domain\Period;
use Tuzex\Ddd\Timing\Domain\Unit\Day;

final class Days extends Period
{
    public static function fromSeconds(Seconds $seconds): self
    {
        return new self(intdiv($seconds->value, Day::SECONDS_PER_DAY));
    }
}

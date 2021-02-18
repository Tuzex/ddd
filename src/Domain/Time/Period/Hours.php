<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Time\Period;

use Tuzex\Ddd\Domain\Time\Period;
use Tuzex\Ddd\Domain\Time\Unit\Hour;

final class Hours extends Period
{
    public static function fromSeconds(Seconds $seconds): self
    {
        return new self(intdiv($seconds->value, Hour::SECONDS_PER_HOUR));
    }
}

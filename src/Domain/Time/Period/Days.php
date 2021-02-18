<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Time\Period;

use Tuzex\Ddd\Domain\Time\Period;
use Tuzex\Ddd\Domain\Time\Unit\Day;

final class Days extends Period
{
    public static function fromSeconds(Seconds $seconds): self
    {
        return new self(intdiv($seconds->value, Day::SECONDS_PER_DAY));
    }
}

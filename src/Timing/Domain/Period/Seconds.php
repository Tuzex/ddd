<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Timing\Domain\Period;

use Tuzex\Ddd\Timing\Domain\Period;
use Tuzex\Ddd\Timing\Domain\Unit\Day;
use Tuzex\Ddd\Timing\Domain\Unit\Hour;
use Tuzex\Ddd\Timing\Domain\Unit\Minute;

final class Seconds extends Period
{
    public static function fromDays(Days $days): self
    {
        return new self($days->value * Day::SECONDS_PER_DAY);
    }

    public static function fromHours(Hours $hours): self
    {
        return new self($hours->value * Hour::SECONDS_PER_HOUR);
    }

    public static function fromMinutes(Minutes $minutes): self
    {
        return new self($minutes->value * Minute::SECONDS_PER_MINUTE);
    }

    public function compare(self $that): int
    {
        return $this->absolute()->value <=> $that->absolute()->value;
    }

    public function increase(self $seconds): self
    {
        return new self($this->value + $seconds->value);
    }

    public function decrease(self $seconds): self
    {
        return new self($this->value - $seconds->value);
    }
}

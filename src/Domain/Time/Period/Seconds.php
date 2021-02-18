<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Time\Period;

use Tuzex\Ddd\Domain\Time\Period;
use Tuzex\Ddd\Domain\Time\Unit\Day;
use Tuzex\Ddd\Domain\Time\Unit\Hour;
use Tuzex\Ddd\Domain\Time\Unit\Minute;

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

    public function equals(self $that): bool
    {
        return 0 === $this->compareTo($that);
    }

    public function compareTo(self $that): int
    {
        return $this->value <=> $that->value;
    }

    public function increase(self $that): self
    {
        return new self($this->value + $that->value);
    }

    public function decrease(self $that): self
    {
        return new self($this->value - $that->value);
    }
}

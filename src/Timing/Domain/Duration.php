<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Timing\Domain;

use Tuzex\Ddd\Timing\Domain\Period\Days;
use Tuzex\Ddd\Timing\Domain\Period\Hours;
use Tuzex\Ddd\Timing\Domain\Period\Minutes;
use Tuzex\Ddd\Timing\Domain\Period\Seconds;

final class Duration
{
    public function __construct(
        public readonly Seconds $seconds
    ) {}

    public static function inDays(int $days): self
    {
        return new self(Seconds::fromDays(new Days($days)));
    }

    public static function inHours(int $hours): self
    {
        return new self(Seconds::fromHours(new Hours($hours)));
    }

    public static function inMinutes(int $minutes): self
    {
        return new self(Seconds::fromMinutes(new Minutes($minutes)));
    }

    public static function inSeconds(int $seconds): self
    {
        return new self(new Seconds($seconds));
    }

    public function equals(self $that): bool
    {
        return $this->seconds->equals($that->seconds);
    }

    public function longerThan(self $that): bool
    {
        return 0 < $this->seconds->compare($that->seconds);
    }

    public function longerThanOrEqualTo(self $that): bool
    {
        return 0 <= $this->seconds->compare($that->seconds);
    }

    public function shorterThan(self $that): bool
    {
        return 0 > $this->seconds->compare($that->seconds);
    }

    public function shorterThanOrEqualTo(self $that): bool
    {
        return 0 >= $this->seconds->compare($that->seconds);
    }

    public function length(): Seconds
    {
        return $this->seconds;
    }

    public function forward(): Seconds
    {
        return $this->seconds->absolute();
    }

    public function backward(): Seconds
    {
        return $this->seconds->negated();
    }

    public function days(): Days
    {
        return Days::fromSeconds($this->seconds);
    }

    public function hours(): Hours
    {
        return Hours::fromSeconds($this->seconds);
    }

    public function minutes(): Minutes
    {
        return Minutes::fromSeconds($this->seconds);
    }
}

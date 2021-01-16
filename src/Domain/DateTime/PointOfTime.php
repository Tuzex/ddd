<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime;

use Tuzex\Ddd\Domain\DateTime\Duration\Seconds;

final class PointOfTime
{
    public function __construct(
        private Seconds $seconds
    ) {}

    public static function set(int $instant): self
    {
        return new self(new Seconds($instant));
    }

    public function equals(PointOfTime $that): bool
    {
        return 0 === $this->compareTo($that);
    }

    public function isLaterThan(PointOfTime $that): bool
    {
        return 0 < $this->compareTo($that);
    }

    public function isLateOrEqualThan(PointOfTime $that): bool
    {
        return 0 <= $this->compareTo($that);
    }

    public function isEarlierThan(PointOfTime $that): bool
    {
        return 0 > $this->compareTo($that);
    }

    public function isEarlierOrEqualThan(PointOfTime $that): bool
    {
        return 0 >= $this->compareTo($that);
    }

    public function isBetweenInclusive(PointOfTime $from, PointOfTime $to): bool
    {
        return $this->isLateOrEqualThan($from) && $this->isEarlierOrEqualThan($to);
    }

    public function isBetweenExclusive(PointOfTime $from, PointOfTime $to): bool
    {
        return $this->isLaterThan($from) && $this->isEarlierThan($to);
    }

    private function compareTo(PointOfTime $that): int
    {
        return $this->seconds <=> $that->seconds;
    }
}

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

    public function equals(self $that): bool
    {
        return 0 === $this->compareTo($that);
    }

    public function isLaterThan(self $that): bool
    {
        return 0 < $this->compareTo($that);
    }

    public function isLateOrEqualThan(self $that): bool
    {
        return 0 <= $this->compareTo($that);
    }

    public function isEarlierThan(self $that): bool
    {
        return 0 > $this->compareTo($that);
    }

    public function isEarlierOrEqualThan(self $that): bool
    {
        return 0 >= $this->compareTo($that);
    }

    public function isBetweenInclusive(self $from, self $to): bool
    {
        return $this->isLateOrEqualThan($from) && $this->isEarlierOrEqualThan($to);
    }

    public function isBetweenExclusive(self $from, self $to): bool
    {
        return $this->isLaterThan($from) && $this->isEarlierThan($to);
    }

    private function compareTo(self $that): int
    {
        return $this->seconds <=> $that->seconds;
    }
}

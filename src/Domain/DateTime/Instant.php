<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime;

use Tuzex\Ddd\Domain\DateTime\Period\Seconds;

final class Instant
{
    public function __construct(
        private Seconds $seconds
    ) {}

    public static function of(int $seconds): self
    {
        return new self(new Seconds($seconds));
    }

    public function equals(self $that): bool
    {
        return 0 === $this->seconds->compareTo($that->seconds);
    }

    public function isLaterThan(self $that): bool
    {
        return 0 < $this->seconds->compareTo($that->seconds);
    }

    public function isLaterOrEqualThan(self $that): bool
    {
        return 0 <= $this->seconds->compareTo($that->seconds);
    }

    public function isEarlierThan(self $that): bool
    {
        return 0 > $this->seconds->compareTo($that->seconds);
    }

    public function isEarlierOrEqualThan(self $that): bool
    {
        return 0 >= $this->seconds->compareTo($that->seconds);
    }

    public function isBetweenInclusive(self $from, self $to): bool
    {
        return $this->isLaterOrEqualThan($from) && $this->isEarlierOrEqualThan($to);
    }

    public function isBetweenExclusive(self $from, self $to): bool
    {
        return $this->isLaterThan($from) && $this->isEarlierThan($to);
    }

    public function move(Seconds $seconds): self
    {
        return new self($this->seconds->increase($seconds));
    }

    public function difference(self $that): Seconds
    {
        return $this->seconds->decrease($that->seconds->absolute());
    }

    public function seconds(): Seconds
    {
        return $this->seconds;
    }
}

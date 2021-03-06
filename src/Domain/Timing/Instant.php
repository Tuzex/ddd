<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing;

use Tuzex\Ddd\Domain\Timing\UniversalTime\TimePeriod\Seconds;

final class Instant
{
    public function __construct(
        private Seconds $epochSeconds
    ) {}

    public static function of(int $epochSeconds): self
    {
        return new self(
            new Seconds($epochSeconds)
        );
    }

    public function equals(self $that): bool
    {
        return $this->epochSeconds->equals($that->epochSeconds);
    }

    public function compare(self $that): int
    {
        return $this->epochSeconds->compare($that->epochSeconds);
    }

    public function shift(Seconds $seconds): self
    {
        return new self(
            $this->epochSeconds->increase($seconds)
        );
    }

    public function delta(self $that): Seconds
    {
        return $this->epochSeconds->decrease($that->epochSeconds->absolute());
    }

    public function epochSeconds(): Seconds
    {
        return $this->epochSeconds;
    }
}

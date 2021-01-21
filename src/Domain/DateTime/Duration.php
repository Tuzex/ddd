<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime;

use Tuzex\Ddd\Domain\DateTime\Period\Days;
use Tuzex\Ddd\Domain\DateTime\Period\Hours;
use Tuzex\Ddd\Domain\DateTime\Period\Minutes;
use Tuzex\Ddd\Domain\DateTime\Period\Seconds;

final class Duration
{
    public function __construct(
        private Seconds $seconds
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

    public function isLongerThan(self $that): bool
    {
        return 0 < $this->seconds->compareTo($that->seconds);
    }

    public function isLongerOrEqualThan(self $that): bool
    {
        return $this->isLongerThan($that) || $this->equals($that);
    }

    public function isShorterThan(self $that): bool
    {
        return 0 > $this->seconds->compareTo($that->seconds);
    }

    public function isShorterOrEqualThan(self $that): bool
    {
        return $this->isShorterThan($that) || $this->equals($that);
    }

    public function length(): Seconds
    {
        return $this->seconds;
    }

    public function forward(): Seconds
    {
        return $this->seconds->negated();
    }

    public function backward(): Seconds
    {
        return $this->seconds->absolute();
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

    public function seconds(): Seconds
    {
        return $this->seconds;
    }
}

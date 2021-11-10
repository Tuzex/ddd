<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Finance;

final class NominalValue
{
    private float $main;
    private int $sub;

    public function __construct(int $sub, int $fraction)
    {
        $this->main = floatval($sub / $fraction);
        $this->sub = $sub;
    }

    public static function set(int $value, Currency $currency): self
    {
        return new self($value, $currency->fraction());
    }

    public function equals(self $that): bool
    {
        return $that->main === $this->main && $that->sub === $this->sub;
    }

    public function compare(self $that): int
    {
        return $this->sub <=> $that->sub;
    }

    public function mainValue(): float
    {
        return $this->main;
    }

    public function subValue(): int
    {
        return $this->sub;
    }
}

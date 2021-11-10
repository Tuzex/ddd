<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Finance;

abstract class Currency
{
    public function __construct(
        private MainUnit $mainUnit,
        private SubUnit $subUnit,
    ) {}

    public function equals(self $that): bool
    {
        return $this->mainUnit->equals($that->mainUnit) && $this->subUnit->eqals($that->subUnit);
    }

    public function isoCode(): string
    {
        return $this->mainUnit->code();
    }

    public function fraction(): int
    {
        return $this->subUnit->fraction();
    }

    public function precision(): int
    {
        return $this->subUnit->precision();
    }
}

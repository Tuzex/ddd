<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Finance\MonetaryUnit\Currency;

use Webmozart\Assert\Assert;

final class SubUnit
{
    public function __construct(
        private string $code,
        private string $symbol,
        private int $fraction,
    ) {
        Assert::notEmpty($this->code);
        Assert::notEmpty($this->symbol);
        Assert::oneOf($this->fraction, [1, 10, 100, 1000]);
    }

    public function eqals(self $that): bool
    {
        return $that->code === $this->code
            && $that->symbol === $this->symbol
            && $that->fraction === $this->fraction;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function symbol(): string
    {
        return $this->symbol;
    }

    public function fraction(): int
    {
        return $this->fraction;
    }

    public function precision(): int
    {
        return intval(
            log10($this->fraction)
        );
    }
}

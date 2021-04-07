<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Finance\MonetaryUnit\Currency;

use Webmozart\Assert\Assert;

final class MainUnit
{
    public function __construct(
        private string $code,
        private string $symbol,
    ) {
        Assert::regex($this->code, '/^[A-Z]{3}$/');
        Assert::notEmpty($this->symbol);
    }

    public function equals(self $that): bool
    {
        return $that->code === $this->code && $that->symbol === $this->symbol;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function symbol(): string
    {
        return $this->symbol;
    }
}

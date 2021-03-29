<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Location;

use Webmozart\Assert\Assert;

abstract class Postcode
{
    public function __construct(
        private string $code
    ) {
        Assert::notEmpty($this->code);
    }

    public function equals(self $that): bool
    {
        return $that->code === $this->code;
    }

    public function asString(): string
    {
        return $this->code;
    }
}

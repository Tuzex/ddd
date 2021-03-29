<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Location;

use Webmozart\Assert\Assert;

final class Street
{
    public function __construct(
        private string $name
    ) {
        Assert::notEmpty($this->name);
        Assert::maxLength($this->name, 100);
    }

    public function equals(self $that): bool
    {
        return $that->name === $this->name;
    }

    public function asString(): string
    {
        return $this->name;
    }
}

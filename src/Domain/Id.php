<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

use Stringable;

abstract class Id implements Identifier, Stringable
{
    public function __toString(): string
    {
        return (string) $this->value();
    }

    public function equals(Identifier $another): bool
    {
        return $this->value() === $another->value();
    }

    abstract public function value(): int|string;
}

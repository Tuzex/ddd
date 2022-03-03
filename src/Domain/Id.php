<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

abstract class Id implements Identifier
{
    public function equals(Identifier $another): bool
    {
        return $this->value() === $another->value();
    }

    abstract public function value(): int|string;
}

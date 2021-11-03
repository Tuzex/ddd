<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing;

abstract class Unit
{
    public function __construct(
        private int $value
    ) {}

    public function equals(self $that): bool
    {
        return $this::class === $that::class && $that->value === $this->value;
    }

    public function asNumber(): int
    {
        return $this->value;
    }
}

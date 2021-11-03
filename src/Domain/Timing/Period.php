<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing;

abstract class Period
{
    final public function __construct(
        protected int $value
    ) {}

    public function equals(self $that): bool
    {
        return $this::class === $that::class && $that->value === $this->value;
    }

    public function positive(): bool
    {
        return $this->value >= 0;
    }

    public function negative(): bool
    {
        return $this->value < 0;
    }

    public function negated(): static
    {
        return new static((int) -abs($this->value));
    }

    public function absolute(): static
    {
        return new static((int) abs($this->value));
    }

    public function asNumber(): int
    {
        return $this->value;
    }
}

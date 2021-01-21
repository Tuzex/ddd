<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime\Period;

abstract class Period
{
    final public function __construct(
        protected int $value
    ) {}

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
        return new static(-abs($this->value));
    }

    public function absolute(): static
    {
        return new static(abs($this->value));
    }

    public function value(): int
    {
        return $this->value;
    }
}

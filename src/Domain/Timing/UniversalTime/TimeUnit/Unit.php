<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing\UniversalTime\TimeUnit;

abstract class Unit
{
    protected function __construct(
        private int $value
    ) {}

    abstract public static function of(int $value): self;

    public function equals(self $that): bool
    {
        return $this::class === $that::class && $that->value === $this->value;
    }

    public function asNumber(): int
    {
        return $this->value;
    }
}

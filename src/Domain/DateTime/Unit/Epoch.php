<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime\Unit;

final class Epoch
{
    public function __construct(
        private int $value
    ) {
    }

    public function value(): int
    {
        return $this->value;
    }
}

<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime\Duration;

final class Seconds
{
    public function __construct(
        private int $value
    ) {
        /**
         * @todo must be positive or 0
         */
    }

    public function plus(Seconds $that): self
    {
        return new self($this->value + $that->value);
    }

    public function minus(Seconds $that): self
    {
        return new self(0);
    }
}

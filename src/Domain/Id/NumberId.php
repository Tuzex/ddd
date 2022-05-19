<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Id;

use Tuzex\Ddd\Domain\Id;
use Tuzex\Ddd\Domain\Identifier;

class NumberId extends Id implements Identifier
{
    final public function __construct(
        protected int $value,
    ) {
    }

    public static function from(self $origin): static
    {
        return new static($origin->value);
    }

    public function value(): int
    {
        return $this->value;
    }
}

<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Identifier;

use Tuzex\Ddd\Domain\Identifier;
use Webmozart\Assert\Assert;

class StringId extends Id implements Identifier
{
    final public function __construct(
        protected string $value,
    ) {
        Assert::notEmpty($this->value);
        Assert::maxLength($this->value, 255);
    }

    public static function from(self $origin): static
    {
        return new static($origin->value);
    }

    public function value(): string
    {
        return $this->value;
    }
}

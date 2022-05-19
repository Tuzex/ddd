<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Id;

use Tuzex\Ddd\Domain\Id;
use Tuzex\Ddd\Domain\Identifier;
use Webmozart\Assert\Assert;

class UniversalId extends Id implements Identifier
{
    final public function __construct(
        public readonly string $value,
    ) {
        Assert::notEmpty(
            $this->value,
            sprintf('Value of "%s" must be valid UUID, empty string given.', static::class)
        );
        Assert::uuid(
            $this->value,
            sprintf('Value of "%s" must be valid UUID, "%s" given', static::class, $this->value)
        );
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

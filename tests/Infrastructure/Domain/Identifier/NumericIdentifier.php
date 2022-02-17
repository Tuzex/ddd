<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Infrastructure\Domain\Identifier;

use Tuzex\Ddd\Domain\Identifier;

interface NumericIdentifier extends Identifier
{
    public function value(): int;
}

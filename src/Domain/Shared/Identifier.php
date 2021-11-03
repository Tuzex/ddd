<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Shared;

interface Identifier
{
    public function value(): int|string;
}

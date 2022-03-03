<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

interface Identifier
{
    public function equals(self $another): bool;

    public function value(): int|string;
}

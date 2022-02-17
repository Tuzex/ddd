<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

interface Identifier
{
    public function value(): int|string;
}

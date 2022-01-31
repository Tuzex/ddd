<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Core\Domain;

interface Identifier
{
    public function value(): int|string;
}

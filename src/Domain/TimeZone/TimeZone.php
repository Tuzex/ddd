<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\TimeZone;

interface TimeZone
{
    public function designation(): string;

    public function offset(): int;
}


<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\TimeZone;

final class UtcTimeZone implements TimeZone
{
    private string $designation = 'UTC';
    private int $offset = 0;

    public function designation(): string
    {
        return $this->designation;
    }

    public function offset(): int
    {
        return $this->offset;
    }
}

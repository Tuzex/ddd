<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing;

interface Clock
{
    public function instant(): Instant;
}

<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Timing\Domain;

interface Clock
{
    public function instant(): Instant;
}

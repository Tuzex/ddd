<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

interface Clock
{
    public function instant(): Instant;
}

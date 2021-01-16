<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Clock;

use Tuzex\Ddd\Domain\DateTime\PointOfTime;

interface Clock
{
    public function measure(): PointOfTime;
}

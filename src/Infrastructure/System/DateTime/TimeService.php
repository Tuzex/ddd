<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\System\DateTime;

use DateTimeImmutable;

interface TimeService
{
    public function measure(): DateTimeImmutable;
}

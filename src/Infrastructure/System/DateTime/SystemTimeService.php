<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\System\DateTime;

use DateTimeImmutable;
use DateTimeZone;

final class SystemTimeService implements TimeService
{
    public function measure(): DateTimeImmutable
    {
        return new DateTimeImmutable('now', new DateTimeZone('UTC'));
    }
}

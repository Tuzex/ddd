<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Measurement\Domain\Unit;

use Tuzex\Ddd\Measurement\Domain\MeasureUnit;

final class Mililiter extends MeasureUnit
{
    public static function set(): self
    {
        return new self('ml', 0);
    }
}

<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime;

final class Year
{
    public const MIN = -999999;
    public const MAX = 999999;


    public function __construct(int $value)
    {

    }
}

<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain;

use Tuzex\Ddd\Domain\Clock;
use Tuzex\Ddd\Domain\Instant;

final class FakeClock implements Clock
{
    public const PAST = 1617892857;
    public const PRESENT = 1617894106;
    public const FUTURE = 1617894114;

    private Instant $instant;

    public function __construct(int $timestamp)
    {
        $this->instant = Instant::of($timestamp);
    }

    public static function past(): self
    {
        return new self(self::PAST);
    }

    public static function present(): self
    {
        return new self(self::PRESENT);
    }

    public static function future(): self
    {
        return new self(self::FUTURE);
    }

    public function instant(): Instant
    {
        return $this->instant;
    }
}

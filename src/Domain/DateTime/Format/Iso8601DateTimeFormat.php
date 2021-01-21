<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime\Format;

use Tuzex\Ddd\Domain\DateTime\DateTime;
use Tuzex\Ddd\Domain\DateTime\DateTimeFormat;

final class Iso8601DateTimeFormat implements DateTimeFormat
{
    public function __construct(
        private DateTime $dateTime
    ) {}

    public function date(): string
    {
        return vsprintf('%4d-%02d-%02d', [
            $this->dateTime->year()->value(),
            $this->dateTime->month()->value(),
            $this->dateTime->day()->value(),
        ]);
    }

    public function time(): string
    {
        return vsprintf('%02d-%02d-%02d', [
            $this->dateTime->hour()->value(),
            $this->dateTime->minute()->value(),
            $this->dateTime->second()->value(),
        ]);
    }

    public function dateTime(): string
    {
        return sprintf('%sT%s%s', $this->date(), $this->time(), $this->dateTime->timeOffset()->value());
    }

    public function week(): string
    {
        return vsprintf('%4d-W%02d', [
            $this->dateTime->year()->value(),
            $this->dateTime->week()->value(),
        ]);
    }

    public function weekWithDay(): string
    {
        return vsprintf('%4d-W%02d-%d', [
            $this->dateTime->year()->value(),
            $this->dateTime->week()->value(),
            $this->dateTime->dayOfWeek()->value(),
        ]);
    }
}

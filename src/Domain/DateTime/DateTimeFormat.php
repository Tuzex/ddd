<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime;

interface DateTimeFormat
{
    public function date(): string;

    public function time(): string;

    public function dateTime(): string;
}

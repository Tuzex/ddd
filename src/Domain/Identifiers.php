<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

interface Identifiers
{
    public function next(): Identifier;
}

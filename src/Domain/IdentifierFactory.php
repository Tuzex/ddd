<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

interface IdentifierFactory
{
    public function next(): Identifier;
}

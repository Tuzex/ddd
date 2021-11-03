<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Shared\Service;

interface IdentifierGenerator
{
    public function generate(): string;
}

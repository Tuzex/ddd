<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Id;

final class FixedUniversalIds implements UniversalIds
{
    public function __construct(
        private readonly UniversalId $id,
    ) {
    }

    public function next(): UniversalId
    {
        return $this->id;
    }
}

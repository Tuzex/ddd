<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Domain\Id;

use Tuzex\Ddd\Domain\Id\UniversalId;
use Tuzex\Ddd\Domain\Id\UniversalIds;
use Tuzex\Ddd\Infrastructure\Support\Symfony\Uuid\UuidGenerator;

final class UniversalIdFactory implements UniversalIds
{
    public function __construct(
        public readonly UuidGenerator $uidGenerator,
    ) {
    }

    public function next(): UniversalId
    {
        return new UniversalId(
            (string) $this->uidGenerator->generate()
        );
    }
}

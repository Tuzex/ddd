<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Domain\Identifier;

use Symfony\Component\Uid\Uuid;
use Tuzex\Ddd\Domain\Identifier\UniversalId;
use Tuzex\Ddd\Domain\Identifier\UniversalIds;

final class SymfonyUuidFactory implements UniversalIds
{
    public function next(): UniversalId
    {
        return new UniversalId(Uuid::v4()->toRfc4122());
    }
}

<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\Domain\Id;

use Symfony\Component\Uid\Uuid;
use Tuzex\Ddd\Domain\Id\UniversalId;
use Tuzex\Ddd\Domain\Id\UniversalIds;

final class SymfonyUuidFactory implements UniversalIds
{
    public function next(): UniversalId
    {
        return new UniversalId(Uuid::v4()->toRfc4122());
    }
}

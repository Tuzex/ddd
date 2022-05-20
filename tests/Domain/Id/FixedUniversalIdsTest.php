<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Test\Domain\Id;

use PHPUnit\Framework\TestCase;
use Tuzex\Ddd\Domain\Id\FixedUniversalIds;
use Tuzex\Ddd\Domain\Id\UniversalId;

final class FixedUniversalIdsTest extends TestCase
{
    private const UID = '996efe71-a61d-46d7-90f7-3029b3bffd23';

    public function testItReturnsFixatedUniversalIds(): void
    {
        $ids = new FixedUniversalIds(
            new UniversalId(self::UID)
        );

        $id = $ids->next();

        $this->assertSame(self::UID, $id->value);
    }
}

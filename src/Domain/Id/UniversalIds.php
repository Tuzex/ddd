<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Id;

use Tuzex\Ddd\Domain\Identifiers;

interface UniversalIds extends Identifiers
{
    public function next(): UniversalId;
}

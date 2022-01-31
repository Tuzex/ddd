<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Core\Domain;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
final class DomainEventPerception
{
}

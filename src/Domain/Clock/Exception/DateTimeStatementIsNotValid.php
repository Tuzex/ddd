<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Clock\Exception;

use DomainException;

final class DateTimeStatementIsNotValid extends DomainException
{
    public function __construct(string $statement, string $format)
    {
        parent::__construct(sprintf('DateTime statement "%s" does not match format "%s"', $statement, $format));
    }
}

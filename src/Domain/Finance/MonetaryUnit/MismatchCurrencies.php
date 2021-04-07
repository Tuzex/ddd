<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Finance\MonetaryUnit;

use DomainException;

final class MismatchCurrencies extends DomainException
{
    public function __construct(Money $origin, Money $another)
    {
        parent::__construct(
            vsprintf('Mathematical operations are allowed for only the same currency (%s => %s).', [
                $origin->currency()->isoCode(),
                $another->currency()->isoCode(),
            ])
        );
    }
}

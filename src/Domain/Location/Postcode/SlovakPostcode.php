<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Location\Postcode;

use Tuzex\Ddd\Domain\Location\Postcode;
use Webmozart\Assert\Assert;

final class SlovakPostcode extends Postcode
{
    public function __construct(string $code)
    {
        Assert::minLength($code, 5);
        Assert::maxLength($code, 6);
        Assert::regex($code, '^(?:\d{3} ?\d{2})$');

        parent::__construct($code);
    }
}

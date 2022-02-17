<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

interface DomainCommand
{
    public function issuedOn(): DateTime;
}

<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

trait IssueTimeAware
{
    private DateTime $issuedOn;

    public function issuedOn(): DateTime
    {
        return $this->issuedOn;
    }
}

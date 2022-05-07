<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain;

trait IssueTimeAware
{
    private Instant $issuedAt;

    public function issuedAt(): Instant
    {
        return $this->issuedAt;
    }
}

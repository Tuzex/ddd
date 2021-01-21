<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\DateTime;

use Webmozart\Assert\Assert;

final class Interval
{
    public function __construct(
        private Instant $beginning,
        private Instant $end,
    ) {
        Assert::true($this->end->isLaterThan($this->beginning), 'The beginning of the time interval must be earlier than the end.');
    }

    public static function from(Instant $beginning, Duration $duration): self
    {
        return new self($beginning, $beginning->move($duration->forward()));
    }

    public static function to(Instant $end, Duration $duration): self
    {
        return new self($end->move($duration->backward()), $end);
    }

    public function equals(self $that): bool
    {
        return $this->beginning->equals($that->beginning) && $this->end->equals($that->end);
    }

    public function isEarlierThan(self $that): bool
    {
        return $this->end->isEarlierOrEqualThan($that->beginning);
    }

    public function isDuring(self $that): bool
    {
        return $this->end->isLaterOrEqualThan($that->beginning)
            && $this->beginning->isEarlierOrEqualThan($that->end);
    }

    public function isLaterThan(self $that): bool
    {
        return $this->beginning->isLaterOrEqualThan($that->end);
    }

    public function beginsEarlierThan(self $that): bool
    {
        return $this->beginning->isEarlierThan($that->beginning);
    }

    public function beginsDuring(self $that): bool
    {
        return $this->beginning->isLaterOrEqualThan($that->beginning);
    }

    public function beginsLaterThan(self $that): bool
    {
        return $this->beginning->isEarlierThan($that->end);
    }

    public function endsEarlierThan(self $that): bool
    {
        return $this->end->isEarlierThan($that->beginning);
    }

    public function endsDuring(self $that): bool
    {
        return $this->end->isEarlierOrEqualThan($that->end)
            && $this->end->isLaterOrEqualThan($that->beginning);
    }

    public function endsLaterThan(self $that): bool
    {
        return $this->end->isLaterThan($that->end);
    }

    public function extend(Duration $duration): self
    {
        return new self($this->beginning, $this->end->move($duration->forward()));
    }

    public function reduce(Duration $duration): self
    {
        return new self($this->beginning, $this->end->move($duration->backward()));
    }

    public function move(Duration $duration): self
    {
        return new self($this->beginning->move($duration->length()), $this->end->move($duration->length()));
    }

    public function beginning(): Instant
    {
        return $this->beginning;
    }

    public function end(): Instant
    {
        return $this->end;
    }

    public function duration(): Duration
    {
        return new Duration($this->end->difference($this->beginning));
    }
}

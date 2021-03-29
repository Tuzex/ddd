<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Timing;

use Webmozart\Assert\Assert;

final class DateTimeInterval
{
    final private function __construct(
        private DateTime $beginning,
        private DateTime $end,
    ) {
        Assert::true(
            $this->end->isLaterThan($this->beginning),
            'The beginning of the time interval must be earlier than the end.'
        );
    }

    public static function from(DateTime $beginning, Duration $duration): self
    {
        return new self($beginning, $beginning->modify($duration->forward()));
    }

    public static function to(DateTime $end, Duration $duration): self
    {
        return new self($end->modify($duration->backward()), $end);
    }

    public function equals(self $that): bool
    {
        return $this->beginning->equals($that->beginning)
            && $this->end->equals($that->end);
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
        return new self($this->beginning, $this->end->modify($duration->forward()));
    }

    public function reduce(Duration $duration): self
    {
        return new self($this->beginning, $this->end->modify($duration->backward()));
    }

    public function shift(Duration $duration): self
    {
        return new self(
            $this->beginning->modify($duration->length()),
            $this->end->modify($duration->length())
        );
    }

    public function duration(): Duration
    {
        return new Duration($this->end->difference($this->beginning));
    }

    public function beginning(): DateTime
    {
        return $this->beginning;
    }

    public function end(): DateTime
    {
        return $this->end;
    }
}

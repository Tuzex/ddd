<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Infrastructure\System\DateTime;

use DateTimeImmutable;
use DateTimeZone;
use InvalidArgumentException;

final class FixedTimeService implements TimeService
{
    public function __construct(
        private DateTimeImmutable $dateTime,
    ) {}

    public static function fromStamp(int $seconds): self
    {
        return self::fromString(sprintf('%s', $seconds), 'U');
    }

    public static function fromString(string $dateTime, string $format): self
    {
        $timeZone = new DateTimeZone('UTC');

        $dateTime = DateTimeImmutable::createFromFormat($format, $dateTime, $timeZone);
        if (!$dateTime) {
            throw new InvalidArgumentException(
                sprintf('Invalid datetime "%s" (%s).', $dateTime, $format)
            );
        }

        return new self($dateTime);
    }

    public function measure(): DateTimeImmutable
    {
        return $this->dateTime;
    }
}

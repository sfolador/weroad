<?php

namespace App\Data\Value;

class Price
{
    const MULTIPLIER = 100;

    public function __construct(public mixed $value)
    {
    }

    public static function from(mixed $value): self
    {
        return new self($value);
    }

    public function toCents(): int
    {
        return $this->value * self::MULTIPLIER;
    }

    public function fromCents(): float
    {
        return $this->value / self::MULTIPLIER;
    }
}

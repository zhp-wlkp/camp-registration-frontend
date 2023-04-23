<?php

namespace App\CampRegistrationSystem;

use Exception;

class CampId implements \Stringable, \JsonSerializable
{
    public const VALIDATION_REGEX = '^[a-f0-9]{40}$';
    private string $value;
    public function __construct(string $value)
    {
        $value = strtolower($value);
        if (!preg_match('/'.self::VALIDATION_REGEX.'/', $value)) {
            throw new  Exception("Invalid CampId format");
        }
        $this->value = $value;
    }

    public function equals(object $comparable)
    {
        if (!$comparable instanceof self) {
            return false;
        }
        return $this->value === $comparable->value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->getValue();
    }

    public function jsonSerialize()
    {
        return $this->getValue();
    }
}

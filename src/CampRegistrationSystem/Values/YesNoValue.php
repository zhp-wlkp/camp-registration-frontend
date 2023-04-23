<?php

namespace App\CampRegistrationSystem\Values;

use Exception;
use JsonSerializable;
use Stringable;

class YesNoValue implements Stringable, JsonSerializable
{
    public static $availableValues = ['Tak'=>'Tak','Nie'=>'Nie'];

    private string $value;

    public function __construct(string $value)
    {
        if ($value !== null &&
            !in_array($value, static::$availableValues)) {
            throw new Exception("YesNoValue not found");
        }
        $this->value = $value;
    }

    public function equals(object $comparable): bool
    {
        if (!$comparable instanceof self) {
            return false;
        }
        return $this->value === $comparable->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function toString(): string
    {
        return $this->__toString();
    }

    public function jsonSerialize()
    {
        return $this->toString();
    }
}

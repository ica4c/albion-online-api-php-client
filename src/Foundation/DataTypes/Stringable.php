<?php


namespace Albion\API\Foundation\DataTypes;

trait Stringable
{
    abstract public function toString(): string;

    public function __toString()
    {
        return $this->toString();
    }
}

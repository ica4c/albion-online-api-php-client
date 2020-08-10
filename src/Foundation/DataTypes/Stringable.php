<?php


namespace Albion\OnlineDataProject\Foundation\DataTypes;

trait Stringable
{
    abstract public function toString(): string;

    public function __toString()
    {
        return $this->toString();
    }
}

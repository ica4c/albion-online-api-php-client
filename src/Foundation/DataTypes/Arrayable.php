<?php


namespace Albion\OnlineDataProject\Foundation\DataTypes;


trait Arrayable
{
    abstract public function toArray(): array;

    public function __toArray(): array
    {
        return $this->toArray();
    }
}
<?php


namespace Albion\API\Foundation\DataTypes;


trait Arrayable
{
    abstract public function toArray(): array;

    public function __toArray(): array
    {
        return $this->toArray();
    }
}
<?php

namespace Albion\OnlineDataProject\Foundation\DataTypes;

use InvalidArgumentException;
use ReflectionClass;

abstract class Enumerable
{
    use Stringable;

    /**
     * List of allowed values
     * @var array
     */
    public $allowedValues = [];

    /** @var string */
    protected $value;

    /**
     * Enumerable constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        // In case of empty allowed values
        if(empty($this->allowedValues)) {
            $this->allowedValues = (new ReflectionClass(static::class))
                ->getConstants();
        }

        if(!in_array($value, $this->allowedValues, false)) {
            throw new InvalidArgumentException(sprintf('%s is not a compatible %s', $value, static::class));
        }

        $this->value = $value;
    }

    /**
     * @param string $value
     * @return static
     */
    public static function of(string $value) {
        return new static($value);
    }

    /**
     * @param string $eventType
     * @return bool
     */
    public function is(string $eventType): bool {
        if($eventType instanceof static) {
            return $eventType->toString() === $this->toString();
        }

        return $eventType === $this->toString();
    }

    public function toString(): string {
        return $this->value;
    }
}

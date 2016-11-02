<?php

namespace Zerifas\Collections;

class ArrayWrapper extends \ArrayObject
{
    /**
     * Create a new array with all elements that pass the test implemented by the provided function.
     *
     * @param callable $callback Map function ($value, $key) { … }
     *
     * @return ArrayWrapper
     */
    public function filter(callable $callback)
    {
        return new static(Arr::filter($this->toArray(), $callback));
    }

    /**
     * Create a new array with the results of calling a provided function on every element in this array.
     *
     * @param callable $callback Map function ($value, $key) { … }
     *
     * @return ArrayWrapper
     */
    public function map(callable $callback)
    {
        return new static(Arr::map($this->toArray(), $callback));
    }

    /**
     * Get a single item from an array based on its key, or a default value if not set.
     *
     * @param mixed $key     Any valid array key
     * @param mixed $default Default to return if key is not set
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->offsetExists($key) ? $this->offsetGet($key) : $default;
    }

    /**
     * Get the contents of this wrapper as a plain array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getArrayCopy();
    }
}

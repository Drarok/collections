<?php

namespace Zerifas\Collections;

class Arr
{
    /**
     * Create a new array with all elements that pass the test implemented by the provided function.
     *
     * @param array    $arr      The arary to map
     * @param callable $callback Map function ($value, $key) { … }
     *
     * @return mixed
     */
    public static function filter(array $arr, callable $callback)
    {
        $result = [];

        // We can't use array_filter() with ARRAY_FILTER_USE_BOTH since it was added in PHP 5.6,
        // and we are supporting PHP >= 5.5
        $wrapper = function ($value, $key) use (&$result, $callback) {
            if ($callback($value, $key)) {
                $result[$key] = $value;
            }
        };

        // Walk the array, build $result, and reset the internal pointer.
        array_walk($arr, $wrapper);
        reset($result);

        // Indexed arrays are re-indexed from 0, associative ones are left as-is.
        if (is_int(key($result))) {
            $result = array_values($result);
        }

        return $result;
    }

    /**
     * Create a new array with the results of calling a provided function on every element in this array.
     *
     * @param array    $arr      The arary to map
     * @param callable $callback Map function ($value, $key) { … }
     *
     * @return mixed
     */
    public static function map(array $arr, callable $callback)
    {
        $wrapper = function (&$item, $key) use ($callback) {
            $item = $callback($item, $key);
        };
        array_walk($arr, $wrapper);
        return $arr;
    }

    /**
     * Get a single item from an array based on its key, or a default value if not set.
     *
     * @param array $arr     The array to get from
     * @param mixed $key     Any valid array key
     * @param mixed $default Default to return if key is not set
     *
     * @return mixed
     */
    public static function get(array $arr, $key, $default = null)
    {
        return isset($arr[$key]) ? $arr[$key] : $default;
    }

    /**
     * Shorthand way to wrap an array.
     *
     * @param array $arr Input array
     *
     * @return ArrayWrapper
     */
    public static function wrap(array $arr)
    {
        return new ArrayWrapper($arr);
    }
}

<?php

namespace Zerifas\Collections\Test;

use PHPUnit_Framework_TestCase;

use Zerifas\Collections\Arr;
use Zerifas\Collections\ArrayWrapper;

class ArrTest extends PHPUnit_Framework_TestCase
{
    public function testFilterAssoc()
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];
        $expectedData = array_slice($data, 0);

        $expected = [
            'key2' => 'value2',
            'key3' => 'value3',
        ];

        $actual = Arr::filter($data, function ($value, $key) {
            return $key !== 'key1';
        });

        $this->assertEquals($expected, $actual, 'Return value does not match');
        $this->assertEquals($expectedData, $data, 'Input data was mutated');
    }

    public function testFilterIndexed()
    {
        $data = [
            'value1',
            'value2',
            'value3',
        ];
        $expectedData = array_slice($data, 0);

        $expected = [
            'value2',
            'value3',
        ];

        $actual = Arr::filter($data, function ($value, $key) {
            return $key > 0;
        });

        $this->assertEquals($expected, $actual, 'Return value does not match');
        $this->assertEquals($expectedData, $data, 'Input data was mutated');
    }

    public function testMapAssoc()
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];
        $expectedData = array_slice($data, 0);

        $expected = [
            'key1' => 'key1 value1',
            'key2' => 'key2 value2',
            'key3' => 'key3 value3',
        ];

        $actual = Arr::map($data, function ($value, $key) {
            return sprintf('%s %s', $key, $value);
        });

        $this->assertEquals($expected, $actual, 'Return value does not match');
        $this->assertEquals($expectedData, $data, 'Input data was mutated');
    }

    public function testMapIndexed()
    {
        $data = [
            'value1',
            'value2',
            'value3',
        ];
        $expectedData = array_slice($data, 0);

        $expected = [
            '0 value1',
            '1 value2',
            '2 value3',
        ];

        $actual = Arr::map($data, function ($value, $key) {
            return sprintf('%s %s', $key, $value);
        });

        $this->assertEquals($expected, $actual, 'Return value does not match');
        $this->assertEquals($expectedData, $data, 'Input data was mutated');
    }

    public function testGet()
    {
        $data = [
            0 => 'item0',
            'one' => 'item1',
        ];

        $this->assertEquals('item0', Arr::get($data, 0));
        $this->assertEquals('item1', Arr::get($data, 'one'));
        $this->assertSame(null, Arr::get($data, 'no such key'));
        $this->assertSame(42, Arr::get($data, 'no such key', 42));
    }

    public function testWrap()
    {
        $data = [];
        $arr = Arr::wrap($data);

        $this->assertInstanceOf(ArrayWrapper::class, $arr);
    }
}
